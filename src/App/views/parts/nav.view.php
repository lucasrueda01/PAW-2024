    <nav>
        <ul>
            <?php foreach ($this->menu as $item) : ?>                 
                <li><a href="<?= $item['href'] ?>"><?= $item['name']?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

