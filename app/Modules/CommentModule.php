<?php namespace App\Modules;

use App\Models\Site\FiveStar;
use App\Models\Site\ProductsComment;
use App\Models\Site\Term;
use DB;
use App\Models\Site\Product;
use App\Models\Site\Comment;
use Log;

class CommentModule extends BaseModule
{

    public function __construct($connection){
        parent::__construct($connection);
    }

    public function addCommentByLine($line,$time,$mode){

        $data = array(
            'code' => 200,
            'message' =>'success'
        );

        $line = explode('#',$line);
        $sn = $line[0];
        if(empty($sn)){
            $data['message'] = "sn is empty";
            $data['code'] = 500;
            return $data;
        }
        $product = new Product();
        $product->setConnection($this->connection);
        $result  = self::formatCondition($product,array('sn' => $sn))->first();

        if ($result == null) {
            $data['message'] = $sn . " product not found";
            $data['code'] = 500;
            return $data;
        }

        $res = $this->formatCommentData($line,$time,$mode);

        if($res['code'] != 200){
            $data['message'] = $res['message'];
            $data['code'] = 500;
            return $data;
        }

        $comment_data = $res['data'];
        $pid = $result->pid;

        //dd($comment_data);
        $comment = new Comment();
        $cid = $comment->setConnection($this->connection)
                       ->addComment($comment_data);

        if ($cid == 0) {
            $data['message'] = $sn . " insert comment error";
            $data['code'] = 500;
            return $data;
        }

        // insert products_comments
        $productComment = new ProductsComment();
        $affected = $productComment->setConnection($this->connection)
                                   ->addProductComment(array('pid'=>$pid,'cid'=>$cid));

        if (empty($affected)) {
            $data['message'] = $sn . " insert products_comments failed";
            $data['code'] = 500;
            return $data;
        }

        // insert five star
        $commentFiveStar = new FiveStar();
        $affected = $commentFiveStar->setConnection($this->connection)
                                    ->addCommentFiveStar(array('pid'=>$pid,'cid'=>$cid,'uid'=>1, 'grade'=>5,'create' => $time));
        if (empty($affected)){
            $data['message'] = $sn . " insert widget_fivestars failed\n";
            $data['code'] = 500;
            return $data;
        }

        return $data;
    }

    protected function formatCommentData($line,$time,$mode){
        switch($mode){
            case 'insertComments':
                $comment_data = array(
                    'uid' => 1,
                    'nickname' => trim($line[1]),
                    'email' => '',
                    'subject'=> trim($line[2]),
                    'photo_paths' => 's:0:\"\";',
                    'comment' => trim($line[3]),
                    'status' => 1,
                    'from' => 1,   // 1 editor
                    'timestamp'=> $time,
                    'directory_tid'=> 0,
                    'tag_tid' =>0
                );

                return array(
                    'code' => 200,
                    'data' => $comment_data
                );

                break;
            case 'insertCommentsWithTid':
                $tid = $line[1];
                $term   = new Term();
                $result = $term->setConnection($this->connection)->getTermInfo(array('tid' => $tid));
                if(empty($result)){
                    $res['code'] = 500;
                    $res['message'] = 'can not find tid';
                    return $res;
                }

                if($result->vid == 1){
                    $comment_data= array(
                        'directory_tid'=> 0,
                        'tag_tid' => $tid
                    );
                }elseif($result->vid == 3){
                    $comment_data= array(
                        'directory_tid'=> $tid,
                        'tag_tid' => 0
                    );
                }else{
                    $res['code'] = 500;
                    $res['message'] = 'vid type is not right';
                    return $res;
                }

                // insert comment
                $comment_data = array_merge($comment_data,
                    array(
                        'uid' => 1,
                        'nickname' => trim($line[2]),
                        'email' => '',
                        'subject'=> trim($line[3]),
                        'photo_paths' => 's:0:\"\";',
                        'comment' => trim($line[4]),
                        'status' => 1,
                        'from' => 1,   // 1 editor
                        'timestamp'=> $time,
                    )
                );
                return array(
                    'code' => 200,
                    'data' => $comment_data
                );
                break;
        }
        return array('code' => 400, 'message' => 'arguments error');
    }
}