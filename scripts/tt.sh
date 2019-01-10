#!/bin/sh

ACTION=$(expr "$ACTION" : "\([a-zA-Z]\+\).*")

if [ "$ACTION" = "add" ]
then
        mount /mnt/usb
else
        umount /mnt/usb
fi
