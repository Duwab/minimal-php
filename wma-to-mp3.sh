for f in *.wma
do
	echo "Processing $f"
	fmp3="${f/wma/mp3}"
	echo $fmp3
	avconv -i "$f" -acodec libmp3lame -ab 320k "$fmp3"
done
