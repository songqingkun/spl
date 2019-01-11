<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 2019/1/11
 * Time: 10:41
 */

namespace yiswoole\Spl;


class SplStream
{
    private $stream;
    private $seekable;//是否可定位
    private $metadata;
    public function __construct($resource = '', $mode = 'r+')
    {
        switch (gettype($resource)) {
            case 'resource': {
                print_r('resource');
                $this->stream = $resource;
            }
                break;
            case 'object':{
                print_r('object');
                if (method_exists($resource, '__toString')) {
                    $resource = $resource->__toString();
                    $this->stream = fopen('php://memory', $mode);
                    try {
                        if (!empty($resource)) {
                            fwrite($this->stream, $resource);
                        }
                    }catch (\Exception $e) {
                        throw new \InvalidArgumentException('invalid resource type' . gettype($resource));
                    }
                } else {
                    throw new \InvalidArgumentException('invalid resource type' . gettype($resource));
                }
            }
                break;
            default: {
                $this->stream = fopen('php://memory', $mode);
                print_r('default');
                try {
                    $resource = (string)$resource;
                    if (!empty($resource)) {
                        fwrite($this->stream, $resource);
                    }
                }catch (\Exception $e) {
                    throw new \InvalidArgumentException('invalid resource type' . gettype($resource));
                }
            }
        }

        //从文件指针中获取元数据
        $info = stream_get_meta_data($this->stream);
        $this->seekable = $info['seekable'];
        $this->metadata = $info;
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        if (!$this->seekable) {
            throw new \RuntimeException('Stream is not seekable');
        } else {
            if (fseek($this->stream, $offset, $whence) === -1) {
                throw new \RuntimeException('Unable to seek to stream position '
                . $offset . ' whence' . var_export($whence, true));
            }
        }
    }

    public function isSeekable()
    {
        return $this->seekable;
    }

    public function rewind()
    {
        $this->seek(0);
    }

    public function getSize()
    {
        $stat = fstat($this->stream);
        if (isset($stat['size'])){
            return $stat['size'];
        }
        return null;
    }

    public function getContents()
    {
        $contents = stream_get_contents($this->stream);
        if ($contents === false) {
            throw new \RuntimeException('Unable to read stream contents');
        }
        return $contents;
    }

    public function getMetadata($key = null)
    {
        if ($this->metadata && isset($this->metadata[$key])) {
            return $key ? $this->metadata[$key] : $this->metadata;
        }
        return [];
    }

    public function close()
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }

    public function getStream()
    {
        return $this->stream;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->close();
    }

    public function truncate($size = 0)
    {
        return ftruncate($this->stream, $size);
    }

}