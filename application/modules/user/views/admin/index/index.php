<form class="form-horizontal" method="POST" action="">
    <?=$this->getTokenField() ?>
    <ul class="nav nav-tabs">
        <li <?php if(!$this->getRequest()->getParam('showsetfree')) { echo 'class="active"'; } ?>>
            <a href="<?=$this->getUrl(array('controller' => 'index', 'action' => 'index')) ?>">
                <?=$this->getTrans('users') ?>
            </a>
        </li>
        <?php if ($this->get('badge') > 0): ?>
            <li <?php if($this->getRequest()->getParam('showsetfree')) { echo 'class="active"'; } ?>>
                <a href="<?=$this->getUrl(array('controller' => 'index', 'action' => 'index', 'showsetfree' => 1)) ?>">
                    <?=$this->getTrans('setfree'); ?> <span class="badge"><?=$this->get('badge') ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <br />
    <table class="table table-hover table-striped">
        <colgroup>
            <col class="icon_width" />
            <col class="icon_width">
            <col class="icon_width" />
            <col class="col-lg-2" />
            <col class="col-lg-2" />
            <col class="col-lg-2" />
            <col />
        </colgroup>
        <thead>
            <tr>
                <th><?=$this->getCheckAllCheckbox('check_users') ?></th>
                <th></th>
                <th></th>
                <th><?=$this->getTrans('userName') ?></th>
                <th><?=$this->getTrans('userEmail') ?></th>
                <th><?=$this->getTrans('userDateCreated') ?></th>
                <th><?=$this->getTrans('userGroups') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($this->get('userList') != ''): ?>
                <?php
                foreach ($this->get('userList') as $user) {
                    $groups = '';

                    foreach($user->getGroups() as $group) {
                        if ($groups != '') {
                            $groups .= ', ';
                        }

                        $groups .= $group->getName();
                    }

                    if ($groups === '') {
                        $groups = $this->getTrans('noGroupsAssigned');
                    }

                    $dateConfirmed = $user->getDateConfirmed();

                    if ($dateConfirmed->getTimestamp() == 0) {
                        $dateConfirmed = $this->getTrans('notConfirmedYet');
                    }

                    $dateLastActivity = $user->getDateLastActivity();

                    if ($dateLastActivity !== null && $dateLastActivity->getTimestamp() == 0) {
                        $dateLastActivity = $this->getTrans('neverLoggedIn');
                    }
                    ?>
                    <tr>
                        <td>
                            <input value="<?=$user->getId()?>" type="checkbox" name="check_users[]" />
                        </td>
                        <td>
                            <?php  if ($this->getRequest()->getParam('showsetfree')): ?>
                                <a href="<?=$this->getUrl(array('action' => 'setfree', 'id' => $user->getId())) ?>" title="<?=$this->getTrans('setfree') ?>"><i class="fa fa-check text-success"></i></a>
                            <?php else: ?>                                
                                <?=$this->getEditIcon(array('action' => 'treat', 'id' => $user->getId())) ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?=$this->getDeleteIcon(array('action' => 'delete', 'id' => $user->getId())) ?>
                        </td>
                        <td><?=$this->escape($user->getName()) ?></td>
                        <td><?=$this->escape($user->getEmail()) ?></td>
                        <td><?=$this->escape($user->getDateCreated()) ?></td>
                        <td><?=$this->escape($groups) ?></td>
                    </tr>
                    <?php
                }
                ?>
            <?php else: ?>
                <tr>
                    <td colspan="7"><?=$this->getTrans('noUsersExist') ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?=$this->getListBar(array('delete' => 'delete')) ?>
</form>
