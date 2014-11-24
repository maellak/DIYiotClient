#!/bin/ash
. /root/admin/applconfig.sh
date1=`tail -1 /root/api/server/tmptmptmp`
date2=$(date +"%s")
diff=$(($date2-$date1))
#echo "$(($diff / 60)) minutes and $(($diff % 60)) seconds elapsed."
minutes=$(($diff / 60));
if [[ "$minutes" -gt 5 ]]; then
        b=`pgrep -f $diyiotserver:127.0.0.1:$diyiotserver`
        if [ "$b" ]; then
        	kill -9 $b
        fi
        b=`pgrep -f $diyiotsocat:127.0.0.1:$diyiotsocat`
        if [ "$b" ]; then
        	kill -9 $b
        fi
        /root/admin/run_tunnel.php &
fi
