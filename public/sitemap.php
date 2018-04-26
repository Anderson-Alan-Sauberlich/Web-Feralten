<?php
    header("Content-Type: application/xml; charset=UTF-8");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    
    require_once('../config.php');
    require_once('../vendor/autoload.php');
    
    use Module\Application\Model\DAO\Peca as DAO_Peca;
    use Module\Application\Model\OBJ\Peca as OBJ_Peca;
    
    $pecas = DAO_Peca::BuscarPorStatus(1, 2);
    $hoje = date('Y-m-d');
?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <?php foreach ($pecas as $peca) { ?>
    	<?php if ($peca instanceof OBJ_Peca) { ?>
            <url>
            	<loc>https://www.feralten.com.br/pecas/detalhes/<?= $peca->get_url() ?>/</loc>
            	<lastmod><?= $hoje ?></lastmod>
            	<priority>0.64</priority>
            	<changefreq>daily</changefreq>
            </url>
    	<?php } ?>
    <?php } ?>
</urlset>