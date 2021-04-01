<?php
/**
 * @author freegeek
 * 一个函数实现简单实用美观的分页
 */


/**
 * @param number $totalPage 结果集
 * @param number $pageshow 每页显示的记录条数
 * @param number $page 当前页/偏移
 * @param string $name 附加参数名。可直接附加整个query string
 * @param string $value 附加参数值
 * @param string $getName 定义分页参数名，默认为p
 * @param number $is_show_num 规定总记录条数超过多少显示页码 
 
 **/

function page($totalPage,$pageshow,$page,$name='',$value='',$getName='',$is_show_num=''){//可选参数也可以写$getName='p'，可选参数可以给定默认值
    if($page<=0){
        $page=1;
    }
    //规定总记录条数超过多少显示页码，如果没有传参的话，即没有定义，那么默认超过5条显示页码
    $is_show_num=$is_show_num?$is_show_num:5;
    if(!($totalPage>$is_show_num)){
        return false;
    }
    $and="";
    $getName=$getName?$getName:'p';
    if($value || $name){
        $and="&$name=$value";
    }

    $url = $_SERVER ['PHP_SELF'];

    $totalPage/=$pageshow;
    $page_number=ceil($totalPage);
    if($page>$page_number){
        $page=$page_number;
    }

    if($page!=1){
        $page_head="<a  class='a-cn' href=$url?$getName=1$and >首页</a>";
        $page_prev="<a  class='a-cn' href='$url?$getName=".($page-1)."$and'>上一页</a>";
    }else{
        $page_head="<span class='text-cn'>首页</span>";
        $page_prev="<span class='text-cn'>上一页</span>";
    }

    if($page>=$page_number){
        $page_next="<span class='text-cn'>下一页</span>";
        $page_end="<sapn class='text-cn'>尾页</sapn>";

    }else{
        $page_next="<a class='a-cn' href='$url?$getName=".($page+1).$and."'>下一页</a>";
        $page_end="<a class='a-cn' href='$url?$getName=$page_number$and'>尾页</a>";

    }

    $page_for="";
    if($page<=5){
        for($i=1;$i<=10;$i++){
            if($i==$page_number){
                if($page==$page_number){
                    $page_for.="<span class='text-num'>$i</span>";
                    break;
                }

                $page_for.="<a class='a-num' href='".$_SERVER['PHP_SELF']."?$getName=".$i.$and."'>$i</a>";

                break;
            }
            if($page==$i){
                $page_for.="<span class='text-num'>$i</span>";
                continue;
            }

            $page_for.="<a class='a-num' href='".$_SERVER['PHP_SELF']."?$getName=".$i."$and'>$i</a>";
        }
    }else{

        for ($i=($page-4);$i<=($page+5);$i++){
            if($i==$page_number){
                if($page==$page_number){
                    $page_for.="<span class='text-num'>$i</span>";
                    break;
                }
                $page_for.="<a class='a-num' href='".$_SERVER['PHP_SELF']."?$getName=".$i."$and'>$i</a>";
                break;
            }
            if($page==$i){
                $page_for.="<span class='text-num'>$i</span>";
                continue;
            }
            $page_for.="<a class='a-num' href='".$_SERVER['PHP_SELF']."?$getName=".$i."$and'>$i</a>";
        }
    }

    return $page_head.$page_prev.$page_for.$page_next.$page_end;

    //($page-1)*$pageshow;

}
