<h2>Articles:</h2>
<?php foreach ($articles as $article) { ?>
   <div style="border-style: solid; margin-bottom: 15px; padding: 20px; border-radius: 15px;">
       <h3><?= $article->title ?></h3>
       <p>Written by <?= $article->authorId ?> <?php if (isset($article->updatedDate)) { ?> on <?= $article->getCreatedDate() ?><?php } ?> <?php if (isset($article->updatedDate)) { ?>, updated on <?= $article->getUpdatedDate() ?> <?php } ?> </p><br/>
       <p style="word-wrap: break-word;"><?= $article->text ?></p><br/>
       <?php if ($currentUser == $article->authorId) { ?>
       <?= $this->tag->linkTo(['article/edit' . '/' . $article->getId(), 'Edit article']) ?>
       <?= $this->tag->linkTo(['article/delete' . '/' . $article->getId(), 'Remove article']) ?>
       <?php } ?>
   </div>
<?php } ?>