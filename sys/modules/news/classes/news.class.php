<?php

#####CONFIG#####
$home = PATH . '/modules/news/templates/index.php'; #Path to index template
####/CONFIG#####

class News 
{
    /*
     * @param int $num Dusplay X articles
     */
    public function show($num)
    {
        $ammo = Engine::protect($num);
	$query = mysql_query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT $num");
		
	$result = ($query);
		
	if( $result )
	{
            while($row = mysql_fetch_array($result, MYSQL_ASSOC))
            {
                echo stripslashes('<article class="news">
<h2 class="topic">' . $row['title'] . '</h2>
<div class="post">
' . $row['content'] . '
</div>
</article>
<hr />
				');							 		 
            }
            echo '
</div>
</body>
</html>	';		 
	}
	else
	{
            echo 'News System is undergoing maintenance. Please check back soon!';
	}
    }
 
    public function paginate($num)
    {
        #Will be updated in the future
    }

    /**
     *
     * @param string $dir Directory to template
     * @param string $file Filename
     * Void
     */
    public function fetchtemplate($dir,$file)
    {
        include(PATH . "/modules/$dir/templates/$file");
    }
}