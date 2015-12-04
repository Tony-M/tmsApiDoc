<h3>Общий список ресурсов</h3><hr/>

<table class="table  table-hover">
    <thead>
    <tr>
        <th>Метод</th>
        <th>Ресурс</th>
        <th>Описание</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($url_list) && is_array($url_list)): ?>
        <?php foreach ($url_list as $row): ?>
            <tr>
                <td><?php echo $row['method']; ?></td>
                <td><?php echo $row['url']; ?></td>
                <td><a href="/?act=resource&r=<?php echo $row['resource'];?>"><?php echo $row['title']; ?></a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>