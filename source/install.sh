#!/bin/bash

if [ ! -f "config.php" ];then
        echo -e "\033[31merror: there seems to be no config file\033[0m"
        echo -e "\033[31minstall proccess exit\033[0m"
        exit
fi

if [ ! -d "templates_c" ];then
        echo -e "\033[33mcreate directory\033[0m \033[34mtemplates_c\033[0m"
        mkdir ./templates_c
fi

echo -e "\033[33mchange mode of\033[0m \033[34mtemplates_c\033[0m"
chmod 777 ./templates_c

compiled_file=`ls ./templates_c`
if [ ! $compiled_file = "" ];then
        echo -e "\033[33mremove smarty compiled files\033[0m"
        sudo rm ./templates_c/* -rf
fi

if [ ! -f "./server/smtp.log" ];then
        echo -e "\033[33mcreate file\033[0m server/smtp.log"
        touch ./server/smtp.log
fi
echo -e "\033[33mchange mode of\033[0m server/smtp.log"
chmod 777 ./server/smtp.log

for dir in `ls ./app`
do
        if [ -d "./app/"$dir ];then
                echo -e "\033[32minstall application\033[0m \033[35m"$dir"\033[0m"
                if [ -f "./app/"$dir"/install.sh" ];then
                        cd "./app/"$dir && bash install.sh && cd ../../
                fi
        fi
done

echo -e "\033[32mcs system install successfully!\033[0m"
