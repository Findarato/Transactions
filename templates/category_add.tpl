<form action="" method="post">
	Main Category<select name="addmainCategory">
    <option value="0">New Top Level</option>{foreach from=$mainCate item=cate key=k}
    <option value="{$k}">{$cate}</option>{/foreach}
    </select>
   New Category Name
  <input type="text" name="newCateName" id="newCateName">
   <input type="submit" name="button" id="button" value="Add">
</form>