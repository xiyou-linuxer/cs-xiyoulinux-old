#!/bin/bash

ext_param='php'
ignore_param='vendor/*,storage/*,resources/*,bootstrap/cache/*,app/*,database/*'

phpcs --ignore=$ignore_param --extensions=$ext_param .
