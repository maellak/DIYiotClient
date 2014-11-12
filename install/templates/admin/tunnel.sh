#!/bin/ash                                           
set +e                                               
export TERM='xterm'                                  
#SSH_OPTIONS=" -i /root/id_dsa "                                                                                                                                                                                                
# Always assume initial connection will be successful                                                                                                                                                                           
export AUTOSSH_GATETIME=0                                                                                                                                                                                                       
# Disable echo service, relying on SSH exiting itself                                                                                                                                                                           
export AUTOSSH_PORT=0                                                                                                                                                                                                           
port=$1                                                                                                                                                                                                       
username=$2                                                                                                                                                                                                   
sshhost=$3                                                                                                                                                                                                    
sshport=$4                                                                                                                                                                                                    
SSH_OPTIONS=" -i "                                                                                                                                                                                            
SSH_OPTIONS=$SSH_OPTIONS$5                                                                                                                                                                                    
mkdir /root/log                                                                                                                                                                                               
autossh -f -M monitor_port:$port -- $SSH_OPTIONS -o 'ControlPath none' -o 'StrictHostKeyChecking=no' -R $port:127.0.0.1:$port $username@$sshhost -p$sshport -N > /root/log/l$port.out 2> /root/log/ls$port.out



