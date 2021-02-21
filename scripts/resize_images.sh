#!/bin/bash

########################################################################
# name:         resize_images.sh
# author:       Kenny Robinson, @almostengr
# description:  Batch resize images to be used on websites.
########################################################################

# echo "Removing previous files"

# rm -rf re20*.jpg

echo "Resizing images"

for i in $(ls *jpg);
do 
echo $i
convert -resize 25% $i re$i
rm $i
done

echo "Done resizing images"
