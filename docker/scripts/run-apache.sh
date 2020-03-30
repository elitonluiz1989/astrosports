#!/bin/sh
echo "---> Start apache"
apache2ctl stop && apache2ctl -D FOREGROUND