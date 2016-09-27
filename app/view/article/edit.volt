<?php echo $this->tag->form("article/edit"); ?>

<h2>Edit article</h2>

<fieldset>

<?php 
    foreach ($form as $element) {
        if (is_a($element, 'Phalcon\Forms\Element\Hidden')) {
            echo $element->render();
        } else {
            echo $element->label()."&nbsp;&nbsp;&nbsp;";
            echo $element->render().'<br>';    
        }
    } 

?>
<div class="control-group">
    <?php echo $this->tag->submitButton("Save!") ?>
</div>

</fieldset>

</form>
{{content()}}