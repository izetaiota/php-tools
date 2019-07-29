<?php

/**
 * 压缩包处理类
 */

namespace lib;


class Package
{
	/**
	 * @description 获取压缩包文件列表
	 * @author      [zetaiota]
	 * @since       2019/3/25
	 * @modify
	 *
	 * @param string $filePath 文件路径
	 *
	 * @return array
	 */
	public static function getFileList($filePath)
	{
		header("Content-type: text/html; charset=utf-8");

		if (!file_exists($filePath))
		{
			return ['code' => 400, 'msg' => '压缩包文件不存在或文件路径错误！'];
		}

		//获取压缩包后缀
		$extension = pathinfo($filePath)['extension'];

		if ($extension == 'zip')
		{
			$resource = zip_open($filePath);

			//判断zip压缩包是否损坏
			if (is_numeric($resource))
			{
				return ['code' => 400, 'msg' => '压缩包文件损坏！'];
			}

			//文件夹数据列表
			$data = [];
			while ($dir_resource = zip_read($resource))
			{
				if (!zip_entry_open($resource, $dir_resource))
				{
					continue;
				}
				$file_name = zip_entry_name($dir_resource);

				//是文件加，文件资源指针下移;
				if ((substr($file_name, -1) == '/'))
				{
					continue;
				}
				else
				{
					$filename = basename($file_name);
					$data[]   = $filename;
				}
				zip_entry_close($dir_resource);
			}

			//关闭资源
			zip_close($resource);

			return $data;
		}
		elseif ($extension == 'rar')
		{
			header("content-type:text/html;charset=utf-8");

			$rar = rar_open($filePath) or die("打开失败");

			//如果损坏的话也允许打开
			if (rar_broken_is($rar))
			{

				rar_allow_broken_set(TRUE);

			}

			if (rar_solid_is($rar)) die("压缩包内容为空");

			$entry_list = rar_list($rar) or die("获取条目失败");

			$data = [];
			if ($entry_list)
			{
				foreach ($entry_list as $entry)
				{
					//判读是否为目录
					if (!$entry->isDirectory())
					{
						$data[] = pathinfo($entry->getName())['basename'];
						//echo self::entryName($entry->getName()), "&nbsp;&nbsp;", $entry->getUnpackedSize(), "&&nbsp;&nbsp;", $entry->getFileTime(), '<br/>';
					}
				}
			}

			rar_close($rar);

			return $data;
		}

		return ['code' => 404, 'msg' => '不支持该类型压缩包文件！'];
	}


	/**
	 * @description 防止乱码处理函数
	 * @author      [zetaiota]
	 * @since       2019/3/26
	 * @modify
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	public static function entryName($name)
	{
		return mb_convert_encoding(htmlentities($name, ENT_COMPAT, "UTF-8"), "HTML-ENTITIES", "UTF-8");
	}

	/**
	 * @description
	 * @author    [zetaiota]
	 * @since     2019/3/26
	 * @modify
	 *
	 * @param array  $files   下载文件名数组  ['upload/qrcode/1/100001.jpg', 'upload/qrcode/1/100002.jpg'];
	 * @param string $zipName 下载地址路径 'upload/qrcode/1/download.zip';
	 */
	public static function downloadZip($files, $zipName)
	{
		$zip = new \ZipArchive;

		if ($zip->open($zipName, \ZIPARCHIVE::OVERWRITE | \ZIPARCHIVE::CREATE) !== TRUE)
		{
			exit('无法打开文件，或者文件创建失败');
		}
		foreach ($files as $val)
		{
			//获取原始文件路径
			if (file_exists($val))
			{
				//第二个参数是放在压缩包中的文件名称，如果文件可能会有重复，就需要注意一下
				$zip->addFile($val, basename($val));
			}
		}
		$zip->close();//关闭

		if (!file_exists($zipName))
		{
			exit("无法找到文件"); //即使创建，仍有可能失败
		}

		//如果不要下载，下面这段删掉即可，如需返回压缩包下载链接，只需 return $zipName;
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header('Content-disposition: attachment; filename=' . basename($zipName)); //文件名
		header("Content-Type: application/zip"); //zip格式的
		header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件
		header('Content-Length: ' . filesize($zipName)); //告诉浏览器，文件大小
		@readfile($zipName);
	}
}

