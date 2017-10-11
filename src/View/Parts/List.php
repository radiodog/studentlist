<div>
            <div class="container-fluid row justify-content-center">
            <div>    
		        <h1>Список абитуриентов</h1>
                <h4><small class="text-muted">Просмотр данных</small></h4>
            </div>
            </div>
            <div class="container-fluid justify-content-left">
                    <form class="form-inline"  method="get">
                            <label for="Search-input" class="text-info mr-sm-2">Поиск</label>
                            <input  class="form-control mr-sm-2" id="Search-input" type="text" placeholder="имя, фамилия, группа" aria-label="Search" name="search">
                            <label class="text-info mr-sm-2">Сортровать по:</label>
                            <select  name="sort" class="form-control custom-select">
                                <option value="score" selected>Баллам</option>
                                <option value="name">Имени</option>
                                <option value="surname">Фамилии</option>
                                <option value="groupnumber">Группе</option>
                            </select>
                            <select  name="order" class="form-control custom-select">
                                <option value="DESC" selected>По убыванию</option>
                                <option value="ASC">По возрастанию</option>
                            </select>   
                        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                    </form>
            </div>
        <div class="container-fluid row justify-content-center">
		    <table class="table table-condensed">
                <thead class="bg-info text-white">
                    <tr>
 		                <th>Имя</th>
 		                <th>Фамилия</a></th>
 		                <th>Номер группы</a></th>
 		                <th>баллы</a></th>
                    </tr>
                </thead>
            <tbody>
	            <?php foreach ($this->services['UserDataGateway']->data as $key => $value): ?>
                <?php $thisStudent = ($value->getEmail()==$this->services['UserDataGateway']->getByHash(Student\Helpers\Utils::getCookie())['e_mail']) ? "table-active" : "" ?>    

 	                <tr class="<?=$thisStudent ?>">
 		                <td><?= htmlspecialchars($value->getName(),ENT_QUOTES) ?></td>
 		                <td><?= htmlspecialchars($value->getSurname(),ENT_QUOTES) ?></td>
 		                <td><?= htmlspecialchars($value->getGroupNumber(),ENT_QUOTES) ?></td>
 		                <td><?= htmlspecialchars($value->getScore(),ENT_QUOTES) ?></td>
 	                </tr>
                <?php endforeach; ?>
            </tbody>
	        </table>
        </div>
        </div>
</body>
</html>
<div class="container-fluid row justify-content-left">
    <nav aria-label="...">
        <ul class="pagination pagination-sm">
            <li class="page-item <?=htmlspecialchars($this->setClassForPrev($request))?>">
                <a class="page-link" href="<?= htmlspecialchars($linkPrev)?>" >Previous</a>
            </li>
                <?php if ($totalPages<=3):?>
                <?php for ($i=1; $i < $totalPages+1; $i++):?>
                <?php $class=($request['offset']==$i)?'active':''?>
                    <li class="page-item <?=htmlspecialchars($class)?>">
                        <a class="page-link" href="<?=htmlspecialchars($this->createUrlforPager($request,$i))?>"><?=$i?></a>
                    </li>
                <?php endfor; ?>

                <?php elseif ($totalPages>3):?>
                    <?php if ($request['offset']==1):?>
                        <?php for ($i=1; $i<4; $i++): ?>
                        <?php $class=($request['offset']==$i)?'active':''?>
                        <li class="page-item <?=htmlspecialchars($class)?>">
                            <a class="page-link" href="<?=htmlspecialchars($this->createUrlforPager($request,$i))?>"><?=$i?></a>
                        </li>
                        <?php endfor; ?>    
                    <?php elseif ($request['offset']==$totalPages):?>
                        <?php for ($i=$request['offset']-2; $i<$request['offset']+1; $i++): ?>
                        <?php $class=($request['offset']==$i)?'active':''?>
                        <li class="page-item <?=htmlspecialchars($class)?>">
                            <a class="page-link" href="<?=htmlspecialchars($this->createUrlforPager($request,$i))?>"><?=$i?></a>
                        </li>
                        <?php endfor; ?>
                    <?php elseif (($request['offset']>1)&($request['offset']<$totalPages)):?>
                        <?php for ($i=$request['offset']-1; $i<$request['offset']+2; $i++): ?>
                        <?php $class=($request['offset']==$i)?'active':''?>
                        <li class="page-item <?=htmlspecialchars($class)?>">
                            <a class="page-link" href="<?=htmlspecialchars($this->createUrlforPager($request,$i))?>"><?=$i?></a>
                        </li>
                        <?php endfor; ?>
                    <?php endif; ?>    
                <?php endif; ?> 
            <li class="page-item <?=htmlspecialchars($this->setClassForNext($request,$totalPages))?>">
                <a class="page-link" href="<?= htmlspecialchars($linkNext)?>">Next</a>
            </li>
        </ul>
    </nav>
</div>



