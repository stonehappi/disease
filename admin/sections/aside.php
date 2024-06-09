<div class="list-group">
    <a href="#" class="list-group-item active">
        เมนู
    </a>
    <a href="./index.php" class="list-group-item <?=isset($disease_active) ? "list-group-item-info" : ""?>">โรค</a>
    <a href="./symptom.php" class="list-group-item <?=isset($symptom_active) ? "list-group-item-info" : ""?>">อาการ</a>
    <a href="./advice.php" class="list-group-item <?=isset($advice_active) ? "list-group-item-info" : ""?>">คําแนะนํา</a>
    
</div>