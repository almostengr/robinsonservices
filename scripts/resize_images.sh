#!/bin/bash

########################################################################
# name:         resize_images.sh
# author:       Kenny Robinson, @almostengr
# description:  Batch resize images to be used on websites.
########################################################################

echo "Resizing images"

for i in $(ls *jpg);
do 
echo $i
convert -resize 25% $i re_$i
done

echo "Done resizing images"
