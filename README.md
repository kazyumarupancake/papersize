# papersize
Return paper size.

This returns sizes kinds of paper.
Available sizes are (B0~B10, A0~A10, Letter, Tabroid, Business card(meishi)).

# usage
include('papersize.php')
$paperinfo = new Kazyumaru\papersize;
$papersize = $paperinfo->set('A4','p','mm'); // ->set($paper,$portrait,$unit)
$papersize->width; //210
$papersize->height; //297
$papersize->unit: //mm
$papersize->size; //A4
