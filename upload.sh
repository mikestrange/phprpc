#!/bin/bash

dir=$(cd `dirname $0`; pwd)

scp -r $dir/com/* root@120.77.149.74:/var/www/html/phprpc2/
