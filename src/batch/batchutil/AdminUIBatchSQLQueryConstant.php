<?php
final class AdminUIBatchSQLQueryConstant {

	private function __construct() {

	}

	const SQL_SEL_NON_MATCH = "select npn.Notify_Post_NonMatch_Id, npn.post_id, npn.Requirements, p.ExpireDateTime, m.FirstName, m.LastName, m.EmailAddress from notify_post_nonmatch npn,posts p, members m where npn.post_id=p.id and p.CreatedBy=m.id order by npn.Notify_Post_NonMatch_Id";

	const SQL_DEL_NON_MATCH = "delete from notify_post_nonmatch where post_id = ?";

	const SQL_SEL_NOT_TAXONOMY_MATCH = "select n.Keywords, n.EmailAddress, n.MobileNumber, m.FirstName, m.LastName from notification n, members m where n.Category_Id is not null and n.CreatedBy = m.id";
	
	const SQL_SEL_TAXONOMY_NULL = "select n.Keywords, n.EmailAddress, n.MobileNumber, m.FirstName, m.LastName from notification n, members m where n.Category_Id is null and n.CreatedBy = m.id";
	
	const SQL_GET_ALL_PRODUCT = "SELECT c.Category_Id,c.Category_Name,pm.Product_Category_Map_Id,pm.Product_Name,pm.brand,pm.sub_brand,pm.product_code FROM product_category_map pm, category c where pm.Category_Id=c.Category_Id order by c.Category_Id";
}
?>