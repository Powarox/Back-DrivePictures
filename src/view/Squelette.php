<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="styles/common.css">
    <?php echo $this->linkCss; ?>
    <?php echo $this->scriptJs; ?>
</head>
<body>
    
    <header>
        <div class="menu">
            <nav>
                <ul>
                    <p>Logo</p>
                    <?php
                        foreach ($this->getMenu() as $text => $link) {
                            echo "<a href=\"$link\">$text</a>";
                        }
                    ?>
                </ul>
            </nav>
        </div>
        
        <div class="baniere">
            <h1><?php echo $this->title; ?></h1>
        </div>
    </header>
    
    
    <main>
        <?php echo $this->feedback; ?>

        <?php echo $this->content; ?>
    </main>
    
    
    <footer>
        <p>Contact</p>
    </footer>
</body>
</html>