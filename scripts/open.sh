#!/bin/bash

gpio write 28 0 & sleep 0.3; gpio write 28 1 | echo "DOOR OPEN";
