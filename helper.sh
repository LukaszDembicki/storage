#!/usr/bin/env bash

main() {

#  if [[ -z "$1" ]]
#    then
#      echo "Please provide container name"
#  fi
#  CONTAINER_NAME="$1"


  PS3='Please enter your choice: '
  options=("[docker] Set xdebug.client_host to IP" "[docker] Set xdebug.client_host to internal"
   "[git] Link post-checkout hook" "[git] Unlink post-checkout hook"
   "Quit"
   )
  select opt in "${options[@]}"
  do
      case $opt in
          "[docker] Set xdebug.client_host to IP")
              echo "test"
              ;;
          "[docker] Set xdebug.client_host to internal")
              echo "test"
              ;;
          "[git] Link post-checkout hook")
              echo "Linking post-checkout hook"
              ln -s $PWD/etc/git/hooks/post-checkout.sh ./.git/hooks/post-checkout
              chmod +x ./.git/hooks/post-checkout
              echo "=============  Done ============="
              ;;
          "[git] Unlink post-checkout hook")
              echo "Unlinking post-checkout hook"
              unlink ./.git/hooks/post-checkout
              echo "=============  Done ============="
              ;;
          "Quit")
              break
              ;;
          *) echo invalid option;;
      esac
  done
}

main "$@"
