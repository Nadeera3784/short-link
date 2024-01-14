#!/bin/bash

echo "#### STARTING IMAGE - MYSQL"

# Main Entrypoint
exec /usr/local/bin/docker-entrypoint.sh "$@"
