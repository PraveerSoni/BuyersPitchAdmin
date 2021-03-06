<?php
require_once ('../batch/strategy/EmailPostNotification.php');
require_once ('../batch/strategy/EmailBidNotification.php');
require_once ('../batch/strategy/TaxonamyStrategy.php');
require_once ('../batch/strategy/RequestTaxonomyMatchStrategy.php');
require_once ('../batch/strategy/NotificationTaxonomyMatch.php');
require_once ('../batch/strategy/TableTaxonamyStrategy.php');
class BatchFactory {

	private function __construct() {

	}

	public static function getBatch($batchTypeId) {
		if($batchTypeId == 1) {
			return new EmailPostNotification($batchTypeId);
		} elseif ($batchTypeId == 2) {
			return new EmailBidNotification($batchTypeId);
		} elseif ($batchTypeId == 3) {
			return new TaxonamyStrategy($batchTypeId);
		} elseif ($batchTypeId == 4) {
			return new RequestTaxonomyMatchStrategy($batchTypeId);
		} elseif ($batchTypeId == 5) {
			return new NotificationTaxonomyMatch($batchTypeId);
		} elseif ($batchTypeId == 6) {
			return new TableTaxonamyStrategy($batchTypeId);
		}
		else {
			throw new NoDataFoundException("No Batch Defiend for:: ".$batchTypeId, 4, null);
		}
	}
}
?>
                                                                                                                                                                                                                                                                                                                                                   
