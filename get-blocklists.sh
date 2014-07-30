#! /bin/bash

curl -s https://www.iblocklist.com/lists.php \
|hxwls \
|grep -v png \
|grep 'list=' \
|sed 's|/list.php?list=||g' \
| sed 's|^|http://list.iblocklist.com/?list=|g' \
| sed 's|$|\&fileformat=p2p\&archiveformat=gz|g' > bls


for url in $(cat bl); do
	wget "${url}" -O -  \
	|gunzip \
	| egrep -v '^#' >> list;
done
rm bls
gzip list
echo "Done"
ls -lahtr list.gz
