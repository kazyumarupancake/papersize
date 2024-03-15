<?php
/**
 * 
BSD License
 Copyright (c) 2021-2024, Kazyumaru
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this
   list of conditions and the following disclaimer.
2. Redistributions in binary form must reproduce the above copyright notice,
   this list of conditions and the following disclaimer in the documentation
   and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

The views and conclusions contained in the software and documentation are those
of the authors and should not be interpreted as representing official policies,
either expressed or implied, of the FreeBSD Project.
 *
 *     include('papersize.php')
 *     $paperinfo = new Kazyumaru\papersize;
 *     $papersize = $paperinfo->set('A4','p','mm');
 *     $papersize->width; //210
 *     $papersize->height; //297
 *     $papersize->unit: //mm
 *     $papersize->size; //A4
 */
namespace Kazyumaru;
mb_internal_encoding('UTF-8');
class Papersize{
    public function __construct(){
    }
    //$papersize = new Kazyumaru\papersize;

    public function set($paper,$orientation="p",$unit="mm"):object{
        $paper = strtolower($paper);
        $orientation = strtolower($orientation);
        $unit = strtolower($unit);
        $size = new \stdClass();
        switch($paper){
            case 'b10':
                $size->width = 32;
                $size->height = 45;
                $size->size = "B10";
                break;
            case 'b9':
                $size->width = 45;
                $size->height = 64;
                $size->size = "B9";
                break;
            case 'b8':
                $size->width = 64;
                $size->height = 91;
                $size->size = "B8";
                break;
            case 'b7':
                $size->width = 91;
                $size->height = 128;
                $size->size = "B7";
                break;
            case 'b6':
                $size->width = 128;
                $size->height = 182;
                $size->size = "B6";
                break;
            case 'jisb5':
            case 'b5':
                $size->width = 182;
                $size->height = 257;
                $size->size = "B5";
                break;
            case 'isob5':
                $size->width = 176;
                $size->height = 250;
                $size->size = "ISOB5";
                break;
            case 'b4':
                $size->width = 257;
                $size->height = 364;
                $size->size = "B4";
                break;
            case 'b3':
                $size->width = 364;
                $size->height = 515;
                $size->size = "B3";
                break;
            case 'b2':
                $size->width = 515;
                $size->height = 728;
                $size->size = "B2";
                break;
            case 'b1':
                $size->width = 728;
                $size->height = 1030;
                $size->size = "B1";
                break;
            case 'b0':
                $size->width = 1030;
                $size->height = 1456;
                $size->size = "B0";
                break;
            case 'a10':
                $size->width = 26;
                $size->height = 37;
                $size->size = "A10";
                break;
            case 'a9':
                $size->width = 37;
                $size->height = 52;
                $size->size = "A9";
                break;
            case 'a8':
                $size->width = 52;
                $size->height = 74;
                $size->size = "A8";
                break;
            case 'a7':
                $size->width = 74;
                $size->height = 105;
                $size->size = "A7";
                break;
            case 'a6':
                $size->width = 105;
                $size->height = 148;
                $size->size = "A6";
                break;
            case 'a5':
                $size->width = 148;
                $size->height = 210;
                $size->size = "A5";
                break;
            case 'a4':
                $size->width = 210;
                $size->height = 297;
                $size->size = "A4";
                break;
            case 'a3':
                $size->width = 297;
                $size->height = 420;
                $size->size = "A3";
                break;
            case 'a2':
                $size->width = 420;
                $size->height = 594;
                $size->size = "A2";
                break;
            case 'a1':
                $size->width = 594;
                $size->height = 841;
                $size->size = "A1";
                break;
            case 'a0':
                $size->width = 841;
                $size->height = 1189;
                $size->size = "A0";
                break;
            case 'letter':
                $size->width = 215.9;
                $size->height = 279.4;
                $size->size = "Letter";
                break;
            case 'legal':
                $size->width = 215.9;
                $size->height = 355.6;
                $size->size = "Legal";
                break;
            case 'tabroid':
                $size->width = 279.4;
                $size->height = 431.8;
                $size->size = "Tabroid";
                break;
            case 'bcard':
                $size->width = 55;
                $size->height = 91;
                $size->size = "BusinessCard";
                break;
            default:
                $size->width = 0;
                $size->height = 0;
                $size->size = "undefined";
                break;
        }
        $size->unit = $unit;
        switch($orientation){
            case 'l':
            case 'landscape':
                $size = $this->landscape($size);
                $size->orientation = "landscape";
                break;
            case 'p':
            case 'portrate':
                $size->orientation = "portrate";
                break;
            default:
                $size->orientation = "undefined";
        }


        //conversion
        switch($unit){
            case 'inch':
                $size = $this->mm2inch($size);
                break;
            case 'pt':
                $size = $this->mm2pt($size);
                break;
            case 'q':
                $size = $this->mm2q($size);
                break;
            case 'cm':
                $size = $this->mm2cm($size);
                break;
            case 'px':
                $size = $this->mm2px($size);
            case 'mm':
                $size->unit = "mm";
                break;
            default:
        }
        return $size;
    }
    //用紙の向き
    public function landscape($size):object{
        list($size->width,$size->height) = array($size->height,$size->width);
        return $size;
    }
    //mmからinch
    public function mm2inch($size):object{
        $size->width = $size->width*0.039370;
        $size->height = $size->height*0.039370;
        $size->unit = "inch";
        return $size;
    }
    //mmからpt
    public function mm2pt($size):object{
        $size->width = $size->width*2.835;
        $size->height = $size->height*2.835;
        $size->unit = "pt";
        return $size;
    }
    //mmから級
    public function mm2q($size):object{
        $size->width = $size->width*4;
        $size->height = $size->height*4;
        $size->unit = "Q";
        return $size;
    }
    //mmからcm
    public function mm2cm($size):object{
        $size->width = $size->width/10;
        $size->height = $size->height/10;
        $size->unit = "cm";
        return $size;
    }
    //mmからpx
    public function mm2px($size):object{
        $size->width = $size->width*14;
        $size->height = $size->height*14;
        $size->unit = "px";
        return $size;
    }
}

?>