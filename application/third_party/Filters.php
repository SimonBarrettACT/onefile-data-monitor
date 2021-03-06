<?php

class MyIterator_Filter_Archived extends FilterIterator {

public function accept() {
    $value = $this->current();

    //alluser
    if (array_key_exists('Group', $value)
     && 
     substr($value['Group'], 0, 8) === "Archived") {
        return false;
     }

    //user
    if (array_key_exists('DateArchived', $value)
     && 
     $value['DateArchived']) {
     return false;
    }

    return true;
}

}

class MyIterator_Filter_Whitelist extends FilterIterator {

    public function accept() {
        $value = $this->current();

        if (array_key_exists('UserID', $value)
            && 
            $this->whitelist->islocked($value['UserID'])) {
            return false;
            }
    
        return true;
    }
    
    }

class MyIterator_Filter_Assessor extends FilterIterator {

    public function accept() {
        $value = $this->current();
        //alluser
        if (array_key_exists('Group', $value)
        && 
        $value['Group'] !== "Assessor"
        && 
        $value['Group'] !== "Internal Quality Assurer") {
            return false;
        }
        
        return true;
    }
    
}

class MyIterator_Filter_Learner extends FilterIterator {

    public function accept() {
        $value = $this->current();
        if (array_key_exists('Group', $value)
        && 
        $value['Group'] !== "Learner") {
            return false;
        }
        
        return true;
    }
    
}
    
class MyIterator_Filter_LoggedIn extends FilterIterator {

public function accept() {
    $value = $this->current();
    if (array_key_exists('DateLastLoggedIn', $value)
     && 
     $value['DateLastLoggedIn']) {
        return true;
     }
        
    return false;
}

}

class MyIterator_Filter_LastWeek extends FilterIterator {

public function accept() {
    $value = $this->current();
    if (array_key_exists('DateLastLoggedIn', $value)
     && 
     $value['DateLastLoggedIn']) {
        
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value['DateLastLoggedIn']);
        $dateLastWeek = new DateTime('-7 days');

        return  (($value['Group'] == 'Learner') && ($dateTime >= $dateLastWeek));
     }
        
    return false;
}

}

class MyIterator_Filter_LastMonth extends FilterIterator {

    public function accept() {
        $value = $this->current();
        if (array_key_exists('DateLastLoggedIn', $value)
         && 
         $value['DateLastLoggedIn']) {
            
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value['DateLastLoggedIn']);
            $dateLastWeek = new DateTime('-30 days');
    
            return  (($value['Group'] == 'Learner') && ($dateTime >= $dateLastWeek));
         }
            
        return false;
    }
    
    }

class MyIterator_Filter_Archive extends FilterIterator {

    public function accept() {
        $value = $this->current();
        
        if (array_key_exists('DateCreated', $value) 
            && array_key_exists('DateLogin', $value) 
            && array_key_exists('DateModified', $value)
            && array_key_exists('DateReview', $value)) {
            
            $ci =& get_instance();
            $days       = $ci->config->item('archive_days');
            $modified   = $ci->config->item('archive_modified');
            $review     = $ci->config->item('archive_review');
            $status     = $ci->config->item('archive_status');
 
            // Find users who have a status set to $status
            $return = ($value['LearnerStatus'] !== $status);

            if ($return):
                // Find users who were created more than $days ago
                $dateTime       = DateTime::createFromFormat('Y-m-d H:i:s', $value['DateCreated']);
                $dateCreated    = new DateTime($days);
                $return         = ($dateTime < $dateCreated);
            endif;

            if ($return):
                // Find users who have not logged in in the last $days
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value['DateLogin']);
                $dateArchive = new DateTime($days);
                $return = ($dateTime < $dateArchive);
            endif;

            if ($return):
                // Find users who have been modified in the last $modified
                $dateModified = DateTime::createFromFormat('Y-m-d H:i:s', $value['DateModified']);
                $dateModifiedLimit = new DateTime($modified);
                $return = ($dateModified < $dateModifiedLimit);
            endif;

            if ($return):
                // Find users who have a review in the next $review
                $dateReview = DateTime::createFromFormat('Y-m-d H:i:s', $value['DateReview']);
                $dateReviewLimit = new DateTime($review);
                $dateNow = new DateTime('now');
                $return = !(($dateReview < $dateReviewLimit) and ($dateReview >= $dateNow));
            endif;

            if ($return):
                // Find users who have a status set to $status
                $return = ($value['LearnerStatus'] !== $status);
            endif;

            return $return;
         }
            
        return false;
    }
    
}

