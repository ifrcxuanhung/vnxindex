<section class="section resume_section even" id="article_home">
    <div class="section_header resume_section_header">
        <h2 class="section_title resume_section_title">
            <a href="#">
                <span class="icon icon-align-left"></span>
                <span class="section_name"><?php echo $data['article']['current'][0]['title']; ?></span>
            </a>
            <span class="section_icon"></span>
        </h2>
    </div>
    <div class="section_body resume_section_body">
        <?php
        $img = PARENT_URL . $data['article']['current'][0]['image'];
        echo "<div id='description'>";
        echo "<img style='float: left; width: 25%; padding-right: 10px;' src='{$img}' />";
        echo $data['article']['current'][0]['description'];
        echo "</div>";
        echo "<div id='long_description' style='clear: both; padding-top: 10px;'>{$data['article']['current'][0]['long_description']}</div>";
        ?>
    </div>
</section>