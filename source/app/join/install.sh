#!/bin/bash 

logfiles=("check.log" "register.log" "illegal.log")

for logfile in ${logfiles[@]}
do
        if [ ! -f "$logfile" ];then
                echo -e "\033[33mtouch\033[0m "$logfile
                touch $logfile
        fi
        echo -e "\033[33mchmod of\033[0m "$logfile
        chmod 777 $logfile
done

echo -e "\033[33mchmod of\033[0m config.php"
chmod 777 config.php
