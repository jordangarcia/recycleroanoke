#!/bin/bash

rm -rf ./app/cache/prod/*
chown -R ubuntu:ubuntu ./app/cache/prod/
chmod -R 777 ./app/cache/prod/
