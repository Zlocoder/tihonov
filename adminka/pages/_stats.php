<div class="wrap">
<br />
<center>
<div class="block3" style="margin-left:-0px">
<div class="b-title">Админка</div>
<div style="height:57px;"></div>
<center>

<a href="/adminka/"  class="button7">Статистика проекта</a>
<br />
<a href="index.php?menu=users" class="button7">Список пользователей</a>
<br />
<a href="index.php?menu=viplat" class="button7">Выплаты</a>
</center>
</div>


<div class="block3" style="margin-left:-0px">
<div class="b-title">Админка</div>
<div style="height:57px;"></div>
<center>

<a href="index.php?menu=story_insert"  class="button7">Пополнения</a>
<br />
<a href="index.php?menu=story_buy" class="button7">Покупки</a>
<br />
<a href="index.php?menu=story_swap" class="button7">Обмены</a>
</center>
</div>


<div class="block3" style="margin-left:-0px">
<div class="b-title">Админка</div>
<div style="height:57px;"></div>
<center>

<a href="index.php?menu=story_sell"  class="button7">Продажи</a>
<br />
<a href="index.php?menu=news" class="button7">Новости</a>
<br />
<a href="index.php?menu=compconfig" class="button7">Конкурс рефералов</a>
</center>
</div>

<div class="block3" style="margin-left:-0px">
<div class="b-title">Админка</div>
<div style="height:57px;"></div>
<center>

<a href="index.php?menu=top"  class="button7">ТОП выплат</a>
<br />
<a href="#" class="button7">Свободное место</a>
<br />
<a href="/account/exit" class="button7">Выход</a>
</center>
</div>
</center>

<br />

<center><div style="padding:0px; ">
<div class="">	
<div class="s-bk-lf">
	<div class="tit">Статистика проекта</div>
</div>
<div style="padding:20px">
<div class="silver-bk">
<div class="clr"></div>	

<?PHP

$db->Query("SELECT 
	COUNT(id) all_users, 
	SUM(money_b) money_b, 
	SUM(money_p) money_p, 
	
	SUM(a_t) a_t, 
	SUM(b_t) b_t, 
	SUM(c_t) c_t, 
	SUM(d_t) d_t, 
	SUM(e_t) e_t,
    SUM(f_t) f_t,
	 SUM(g_t) g_t,
	  SUM(h_t) h_t,
	   SUM(i_t) i_t,
	    SUM(j_t) j_t,
		 SUM(k_t) k_t,
		  SUM(l_t) l_t,
		   SUM(m_t) m_t,
		    SUM(n_t) n_t,
			 SUM(o_t) o_t,
			 
	
	SUM(a_b) a_b, 
	SUM(b_b) b_b, 
	SUM(c_b) c_b, 
	SUM(d_b) d_b, 
	SUM(e_b) e_b,
	SUM(f_b) f_b,
	SUM(g_b) g_b,
	SUM(h_b) h_b,
	SUM(i_b) i_b,
	SUM(j_b) j_b,
	SUM(k_b) k_b,
	SUM(l_b) l_b,
	SUM(m_b) m_b,
	SUM(n_b) n_b,
	SUM(o_b) o_b,
	
	
	
	
      
	
	SUM(all_time_a) all_time_a, 
	SUM(all_time_b) all_time_b, 
	SUM(all_time_c) all_time_c, 
	SUM(all_time_d) all_time_d, 
	SUM(all_time_e) all_time_e,
    SUM(all_time_f) all_time_f,
	SUM(all_time_g) all_time_g,
	SUM(all_time_h) all_time_h,
	SUM(all_time_i) all_time_i,
	SUM(all_time_j) all_time_j,
	SUM(all_time_k) all_time_k,
	SUM(all_time_l) all_time_l,
	SUM(all_time_m) all_time_m,
	SUM(all_time_n) all_time_n,
	SUM(all_time_o) all_time_o,
	
	
	
	
	
	SUM(payment_sum) payment_sum, 
	SUM(insert_sum) insert_sum
	
	
	FROM db_users_b");
$data_stats = $db->FetchArray();

?>



<div class="kont"><b>Зарегистрировано пользователей:</b></div><div class="kont"><?=$data_stats["all_users"]; ?> чел.</div>
<br>
<div class="kont"><b>Монет на счетах (Для покупок):</b></div><div class="kont"><?=sprintf("%.0f",$data_stats["money_b"]); ?></div>
<br>
<div class="kont"><b>Монет на счетах (На вывод):</b></div><div class="kont"><?=sprintf("%.0f",$data_stats["money_p"]); ?></div>
<br>
<div class="kont"><b>Куплено пчел Лентяй:</b></div><div class="kont"><?=intval($data_stats["a_t"]); ?> шт.</div>
<br>
<div class="kont"><b>Куплено пчел Обжора:</b></div><div class="kont"><?=intval($data_stats["b_t"]); ?> шт.</div>
<br>
<div class="kont"><b>Куплено пчел Остряк:</b></div><div class="kont"><?=intval($data_stats["c_t"]); ?> шт.</div>
<br>
<div class="kont"><b>Куплено пчел Трудяга:</b></div><div class="kont"><?=intval($data_stats["d_t"]); ?> шт.</div>
<br>
<div class="kont"><b>Доход за все вермя от пчел Лентяй:</b></div><div class="kont"><?=intval($data_stats["all_time_a"]); ?> меда.</div>
<br>
<div class="kont"><b>Доход за все вермя от пчел Обжора:</b></div><div class="kont"><?=intval($data_stats["all_time_b"]); ?> меда.</div>
<br>
<div class="kont"><b>Доход за все вермя от пчел Остряк:</b></div><div class="kont"><?=intval($data_stats["all_time_c"]); ?> меда.</div>
<br>
<div class="kont"><b>Доход за все вермя от пчел Трудяга:</b></div><div class="kont"><?=intval($data_stats["all_time_d"]); ?> меда.</div>
<br>
<div class="kont"><b>Введено пользователями:</b></div><div class="kont"><?=sprintf("%.2f",$data_stats["insert_sum"]); ?> <?=$config->VAL; ?></div>
<br>
<div class="kont"><b>Выплачено пользователям:</b></div><div class="kont"><?=sprintf("%.2f",$data_stats["payment_sum"]); ?> <?=$config->VAL; ?></div>
<br>
  
 </div> 
</div> 
            
	    </div> </div>
		
		</div>	</div>			
<br /><br />