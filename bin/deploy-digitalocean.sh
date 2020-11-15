DROPLET_USERNAME="root";
DROPLET_IP="157.245.252.193";
DROPLET_WWW_ROOT="/var/www/html";

#echo "Clearing out plugins, themes, mu-plugins";
#ssh -t $DROPLET_USERNAME@$DROPLET_IP "rm -r $DROPLET_WWW_ROOT/wp-content/plugins/ $DROPLET_WWW_ROOT/wp-content/mu-plugins/ $DROPLET_WWW_ROOT/wp-content/themes/";
#echo "";

echo "Copying Composer vendor directory...";
rsync -aruv ./vendor/ $DROPLET_USERNAME@$DROPLET_IP:$DROPLET_WWW_ROOT/vendor/
echo "";

echo "Copying post_types_config file..."
rsync -aruv ./wp-content/cw_post_types.json $DROPLET_USERNAME@$DROPLET_IP:$DROPLET_WWW_ROOT/wp-content/;
echo "";

echo "Copying mu-plugins directory...";
rsync -aruv ./wp-content/mu-plugins/ $DROPLET_USERNAME@$DROPLET_IP:$DROPLET_WWW_ROOT/wp-content/mu-plugins/
echo "";

echo "Copying plugins directory...";
rsync -aruv ./wp-content/plugins/ $DROPLET_USERNAME@$DROPLET_IP:$DROPLET_WWW_ROOT/wp-content/plugins/
echo "";

echo "Copying themes directory..."
rsync -aruv ./wp-content/themes/ $DROPLET_USERNAME@$DROPLET_IP:$DROPLET_WWW_ROOT/wp-content/themes/
echo "";
