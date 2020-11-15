# wp.io
My WordPress Playground

---

## DashIcons Helper (TODO)

a static class has been created to facilitate the use of DashIcons

```
DashIcons::building;
DashIcons::analytics;

```

---

## Taxonomy Factory / Helper

###### Option 1. Via file import
1. create a file named `cw_taxonomies.json` and place it in the `wp-content` folder
2. here is an example of the contents

```
{
  "department": {
  }
}
```

----

## PostType Helper

###### Option 1. Via file import
1. create a file named `cw_post_types.json` and place it in the `wp-content` folder
2. here is an example of the contents

```
{
  "Hotel": {
    "menu_icon": "dashicons-building"
  },
  "Report": {
    "menu_icon": "dashicons-analytics",
    "taxonomies": [] //turns off taxonomies for this post type
  }
}
```

###### Option 2. Progammatically (TODO)
```
$book_cpt = new PostType('book');
$book_cpt->icon = DashIcons::Analytics
```

---

## Options Helper (TODO)

###### Option 2. Progammatically (TODO)
```
$my_new_page = new Page('page-slug');
$my_new_page->options->add('option-name')->type = 'radio'
```

---

# TODO:
1. Update the PHP docker image so that i can use
`
"require": {
    "ext-imagick": "*",
}`

2. PostType and Taxonomy class should extend the ConfigImporter class and a callback should be identified so that it can perform the following common functionality
2.1 Look for the file on bootup
2.2 if the file does not exist, bail and log an info message to the logs
2.3. if the file exists and a callback exists, do the callback... maybe the callback should be the same name... so that it can be overridden by extended classes
