<h3>Описание ресурса</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data, 'title'))): ?>

            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data, 'title'); ?></div>
            <hr/>
        <?php endif; ?>

        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data, 'description'))): ?>
            <h4 class="text-primary">Детали:</h4>

            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data, 'description'); ?></div>
            <hr/>
        <?php endif; ?>
        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data,'method'))): ?>
            <h4 class="text-primary">Метод:</h4>

            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data,'method'); ?></div>
            <hr/>
        <?php endif; ?>
        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data, 'url'))): ?>
            <h4 class="text-primary">URL:</h4>
            <code class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data, 'url'); ?></code>
            <hr/>
        <?php endif; ?>
        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data,'headers'))): ?>
            <h4 class="text-primary">Заголовки запроса:</h4>

            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data,'headers'); ?></div>
            <hr/>
        <?php endif; ?>
      <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data,'responseheaders'))): ?>
            <h4 class="text-primary">Заголовки ответа:</h4>

            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data,'responseheaders'); ?></div>
            <hr/>
        <?php endif; ?>
        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data,'get'))): ?>
            <h4 class="text-primary">GET параметры:</h4>

            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data,'get'); ?></div>
            <hr/>
        <?php endif; ?>
        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data,'post'))): ?>
            <h4 class="text-primary">POST параметры:</h4>
            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data,'post'); ?></div>
            <hr/>
        <?php endif; ?>
        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data,'errors'))): ?>
            <h4 class="text-primary">Ошибки:</h4>
            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data,'errors'); ?></div>
            <hr/>
        <?php endif; ?>
        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data,'input'))): ?>
            <h4 class="text-primary">Примеры запроса к API:</h4>
            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data,'input'); ?></div>
            <hr/>
        <?php endif; ?>
        <?php if (!is_null(\tms\ApiDoc\tmsApiDoc::tell($data,'output'))): ?>
            <h4 class="text-primary">Примеры ответа API:</h4>
            <div  class="desc"><?php echo \tms\ApiDoc\tmsApiDoc::tell($data,'output'); ?></div>
            <hr/>
        <?php endif; ?>
    </div>
</div>
