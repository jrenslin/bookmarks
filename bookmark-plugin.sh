#!/bin/sh
# this is a simple example script that demonstrates how bookmarking plugins for newsbeuter are implemented
# (c) 2007 Andreas Krennmair
# (c) 2016 Alexander Batischev

# This one is a slightly modified version of Krennmair & Batischev's script.

url="$1"
title="$2"
description="$3"
feed_title="$4"

echo "${url}\t${title}\t${description}\t${feed_title}\t$(date '+%Y-%m-%d %H:%M')" >> ~/synced_notes/bookmarks.txt
