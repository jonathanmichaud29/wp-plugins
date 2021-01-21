# wp-plugins
Yet Another Wordpress Plugins Directory

This repository includes 
* a folder "wppb-plugin-slug" that comes from wordpress plugin boilerplate at https://wppb.me/
* an executable bash script "replace_plugin_boilerplate.sh" that duplicates the boilerplate folder into a new plugin with some customisation
* a folder "_script_files" that is required by the script to quickly add common utility like the creation of a new post type and taxonomies attached to it


# How to use
1. Allow file execution for "replace_plugin_boilerplate.sh" by running the following command

    chmod +x ./replace_plugin_boilerplate.sh

2. Execute the script
    ./replace_plugin_boilerplate.sh  --pname "Test Plugin Name" --pslug "test-plug-slug" --puri "https://www.plugin-domain.com" --aname "Author Name" --auri "https://www.author-domain.com" --aemail "author.email@domain.com"

Here is the list of arguments
* pname : Plugin Name
* pslug : Plugin Slug
* puri : Plugin URI
* aname : Author Name
* auri : Author URI
* aemail : Author Email

