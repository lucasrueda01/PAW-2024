<nav class="container_nav"> 
    <ul class="nav_menu"> 
        <?php foreach ($this->menu as $item) : ?>                 
            <li class="opciones_nav">
                <a href="<?= $item['href'] ?>"><?= $item['name']?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

