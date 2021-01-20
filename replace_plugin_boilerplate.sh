#!/bin/bash

show_help() {
  echo "---"
  echo "Required options:"
  echo "--pname: Plugin Name"
  echo "--pslug: Plugin Slug"
  echo "--puri: Plugin URI"
  echo "--aname: Author Name"
  echo "--aemail: Author Email"
  echo "--auri: Author URI"
  echo ""
}


CUR_PATH=`pwd`
echo "$CUR_PATH"

# Original values for plugin
ORIG_PLUGIN_FOLDER='wppb-plugin-slug'

ORIG_PLUGIN_NAME='WPPB Plugin Name'
ORIG_PLUGIN_SLUG='wppb-plugin-slug'
ORIG_PLUGIN_URI='https://www.plugin-uri.com'

ORIG_PLUGIN_AUTHOR_NAME='WPPB AUTHOR NAME'
ORIG_PLUGIN_AUTHOR_EMAIL='wppb.author@email.com'
ORIG_PLUGIN_AUTHOR_URI='https://www.wppb-author-uri.com'

# Errors
serror=

# Default Arguments

pname=
pslug=
puri=
aname=
aemail=
auri=

while :; do
  case $1 in
    -h|--help)
      show_help    # Display a usage synopsis.
      exit
      ;;
    --pname)
      if [ "$2" ]; then
          pname=$2
          shift
      else
          die 'ERROR: "--pname" requires a non-empty option argument.'
      fi
      ;;
    --puri)
      if [ "$2" ]; then
          puri=$2
          shift
      else
          die 'ERROR: "--puri" requires a non-empty option argument.'
      fi
      ;;
    --pslug)
      if [ "$2" ]; then
          pslug=$2
          shift
      else
          die 'ERROR: "--pslug" requires a non-empty option argument.'
      fi
      ;;
    --aname)
      if [ "$2" ]; then
          aname=$2
          shift
      else
          die 'ERROR: "--aname" requires a non-empty option argument.'
      fi
      ;;
    --auri)
      if [ "$2" ]; then
          auri=$2
          shift
      else
          die 'ERROR: "--auri" requires a non-empty option argument.'
      fi
      ;;
    --aemail)
      if [ "$2" ]; then
          aemail=$2
          shift
      else
          die 'ERROR: "--auri" requires a non-empty option argument.'
      fi
      ;;
    *)               # Default case: No more options, so break out of the loop.
      break
  esac
  shift
done

echo "RESULTS:"
echo "pname: ${pname}"
echo "pslug: ${pslug}"
echo "puri: ${puri}"
echo "aname: ${aname}"
echo "aemail: ${aemail}"
echo "auri: ${auri}"
echo ""

if [ -z "$pname" ]
  then
    serror="Missing Plugin Name" 
  elif [ -z "$pslug" ]
  then
    serror="Missing Plugin Slug" 
  elif [ -z "$puri" ]
  then
    serror="Missing Plugin URI"
  elif [ -z "$aname" ]
  then
    serror="Missing Author Name" 
  elif [ -z "$auri" ]
  then
    serror="Missing Author URI" 
  elif [ -z "$aemail" ]
  then
    serror="Missing Author Email"
  fi

  if [ -n "${serror}" ]
  then
    echo "ERROR: ${serror}"
    show_help
    exit
fi
echo "ALL GOOD!!!"

DIR_PLUGIN="${CUR_PATH}/${pslug}"

echo "---- Check duplicate directory"
# Delete existing endpoint directory
if [ -d "${DIR_PLUGIN}" ] 
then
  echo "= Delete endpoint directory"
  rm -r "${DIR_PLUGIN}"
fi

echo "= Copy template directory"
cp -r "${CUR_PATH}/${ORIG_PLUGIN_FOLDER}" "${DIR_PLUGIN}/"

echo "= Copy and overwrite custom files to manage post-type/taxonomy registrations"
cp "${CUR_PATH}/_script_files/includes/class-wppb-plugin-slug-post_types.php" "${DIR_PLUGIN}/includes/class-wppb-plugin-slug-post_types.php"
cp "${CUR_PATH}/_script_files/includes/class-wppb-plugin-slug-activator.php" "${DIR_PLUGIN}/includes/class-wppb-plugin-slug-activator.php"

echo "= Change current directory to new plugin folder"
cd "${pslug}"

echo "= Replace all filenames for new plugin slug"
find . -name "*plugin-slug*" | while read line; do
  mv "${line}" "${line/$ORIG_PLUGIN_FOLDER/$pslug}"
done

echo "= Replace Plugin URI within all files"
find . -type f -exec sed -i "s,$ORIG_PLUGIN_URI,$puri,g" {} +

echo "= Replace Plugin Name within all files"
find . -type f -exec sed -i "s,$ORIG_PLUGIN_NAME,$pname,g" {} +

echo "= Replace Plugin URI within all files"
find . -type f -exec sed -i "s,$ORIG_PLUGIN_SLUG,$pslug,g" {} +

echo "= Replace Author URI within all files"
find . -type f -exec sed -i "s,$ORIG_PLUGIN_AUTHOR_URI,$auri,g" {} +

echo "= Replace Author Name within all files"
find . -type f -exec sed -i "s,$ORIG_PLUGIN_AUTHOR_NAME,$aname,g" {} +

echo "= Replace Author URI within all files"
find . -type f -exec sed -i "s,$ORIG_PLUGIN_AUTHOR_EMAIL,$aemail,g" {} +

echo "= Replace Constants"
ORIG_CONSTANT_SLUG=${ORIG_PLUGIN_FOLDER^^}
ORIG_CONSTANT_SLUG="${ORIG_CONSTANT_SLUG/-/_}"

NEW_CONSTANT_SLUG=${pslug^^}
NEW_CONSTANT_SLUG="${NEW_CONSTANT_SLUG//-/_}"

find . -type f -exec sed -i "s/$ORIG_CONSTANT_SLUG/$NEW_CONSTANT_SLUG/g" {} +

echo "= Replace functions"
ORIG_FUNCTION_SLUG="${ORIG_CONSTANT_SLUG,,}"
NEW_FUNCTION_SLUG="${NEW_CONSTANT_SLUG,,}"
find . -type f -exec sed -i "s/$ORIG_FUNCTION_SLUG/$NEW_FUNCTION_SLUG/g" {} +

echo "= Replace Class Names"
ORIG_CLASSNAME="${ORIG_FUNCTION_SLUG//_/ }"
ORIG_CLASSNAME=$(sed 's/\<./\U&/g' <<< "$ORIG_CLASSNAME")
ORIG_CLASSNAME="${ORIG_CLASSNAME// /_}"

NEW_CLASSNAME="${NEW_FUNCTION_SLUG//_/ }"
NEW_CLASSNAME=$(sed 's/\<./\U&/g' <<< "$NEW_CLASSNAME")
NEW_CLASSNAME="${NEW_CLASSNAME// /_}"

find . -type f -exec sed -i "s/$ORIG_CLASSNAME/$NEW_CLASSNAME/g" {} +