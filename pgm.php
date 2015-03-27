<?php 

class PGM{
    public
        $magicNumber = '',
        $pixelArray = array(),
        $width = 0,
        $height = 0,
        $grayMax = 0,
        $createdBy = '';

    public function loadPGM($filename){
        $this->grayMax = $this->height = $this->width = $this->magicNumber = 0;
        $this->pixelArray = array();
        $fh = fopen($filename, 'rb');
        while($line = fgets($fh)){
            if(strpos($line, '#') === 0){
                continue;
            }
            if(!$this->grayMax){
                $arr = preg_split('/\s+/', trim($line));
                if($arr && !$this->magicNumber){
                    $this->magicNumber = array_shift($arr);
                    if($this->magicNumber != 'P5'){
                        throw new Exception("Unsupported PGM version");
                    }
                }
                if($arr && !$this->width)
                    $this->width = array_shift($arr);
                if($arr && !$this->height)
                    $this->height = array_shift($arr);
                if($arr && !$this->grayMax)
                    $this->grayMax = array_shift($arr);
            }else{
                $unpackMethod = ($this->grayMax > 255)?'n*':'C*';
                foreach(unpack($unpackMethod, $line) as $pixel){
                    $this->pixelArray[] = $pixel;
                }
            }
        }
        fclose($fh);
    }

    public function savePGM($filename){
        $fh = fopen($filename, 'wb');
        $this->magicNumber = 'P5';
        fwrite($fh, "{$this->magicNumber}\n");
        if($this->createdBy){
            fwrite($fh, "# {$this->createdBy}\n");
        }
        fwrite($fh, "{$this->width} {$this->height}\n");
        fwrite($fh, "{$this->grayMax}\n");
        $packMethod = ($this->grayMax > 255)?'n*':'C*';
        fwrite($fh, call_user_func_array('pack', array_merge(array($packMethod), $this->pixelArray)));  
        fclose($fh);
    }
}

?>