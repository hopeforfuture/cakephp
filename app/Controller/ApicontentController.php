<?php
App::uses('AppController', 'Controller');
require_once(ROOT . DS . 'app' . DS .'Vendor' . DS  .  'simple_html_dom.php');
class ApicontentController extends AppController
{
	public $helpers = array('Html','Form');

	public function scrapdata()
	{
		if($this->request->is('get'))
		{
			if(array_key_exists('url', $this->request->query))
			{
				$url = $this->request->query['url'];
			}
			else 
			{
				$url = 'http://localhost';
			}
			
			$dom = file_get_html($url, false);
			//collect all user’s reviews into an array
			$answer = array();
			if(!empty($dom)) 
			{
				$divClass = $title = '';
				$i = 0;
				foreach($dom->find('.review-container') as $divClass) 
				{
					//title
					foreach($divClass->find('.title') as $title ) 
					{
						$answer[$i]['title'] = $title->plaintext;
					}
					//ipl-ratings-bar
					foreach($divClass->find('.ipl-ratings-bar') as $ipl_ratings_bar ) 
					{
						$answer[$i]['rate'] = trim($ipl_ratings_bar->plaintext);
					}
					//content
					foreach($divClass->find('div[class=text show-more__control]') as $desc) 
					{
						$text = html_entity_decode($desc->plaintext);
						$text = preg_replace('/\&#39;/', "'", $text);
						$answer[$i]['content'] = html_entity_decode($text);
					}
					$i++;
				}
			}
			else {
				$answer = array('msg'=>'No response found.');
			}

			echo json_encode($answer);
			exit;
		}
	}


	public function advancescrap()
	{
		$url = '';
		$data = array();
		if($this->request->is('get')) {
			if(array_key_exists('url', $this->request->query)) {
				$url = $this->request->query['url'];
				//$dom = new SimpleHtmlDom();
				switch($url)
				{
					case 'https://www.youtube.com/':
					break;

					case 'https://sourceforge.net/':
						$dom = file_get_html($url, false);

						if(!empty($dom))
						{
							$divClass = '';
							$innerclass = '';
							$ul = '';
							$ulnew = '';
							$li = '';
							$linew = '';
							$parent_cat = '';
							$subcat = '';
							$nested_cat = '';
							$nested = '';
							$child_link = '';
							$index = 0;
							$i = 0;
							$j = 0;
							$k = 0;
							

							foreach($dom->find('div[class="links"]') as $divClass)
							{
								
								foreach($divClass->find('div[class="nav-dropdown"]') as $innerclass)
								{
									
									$inner = $innerclass->find('a', 0);
									$parent_cat = $inner->plaintext;
									$data[$i] = array(
										'parent' => $parent_cat
									);

									foreach($innerclass->find('ul[class="nav-dropdown-menu"]') as $ul)
									{
										foreach($ul->find('li') as $li)
										{
											
											$data[$i]['subcat'][$j] = $li->find('a', 0)->plaintext;
											$j++;
										}
										$j = 0;

									}

									foreach($innerclass->find('ul[class="nav-dropdown-menu  dropdown-with-pane"]') as $ulnew)
									{

										foreach($ulnew->find('li[class="pane-parent"]') as $linew)
										{
											$inner = $linew->find('a', 0);
											$data[$i]['subcat'][$j] = $inner->plaintext;
											foreach($linew->find('div[class="sub-pane"]') as $nested)
											{
			
												$nested_parent = $nested->find('div[class="heading"]', 0)->plaintext;
												foreach($nested->find('a') as $child_link)
												{
													if($k == 0)
													{
														$data[$i]['nestedcat']['subcat'][$j]['parent_nest'] = $nested_parent;
													}
													$data[$i]['nestedcat']['subcat'][$j][$k] = $child_link->plaintext;
													$k++;
												}
												$k = 0;
												
											}
											
											$j++;
										}
										$j = 0;

									}

									$i++;
								}
							}

							echo json_encode($data);
							/*echo "<pre>";
							print_r($data);
							echo "</pre>";*/
							exit;
						}
					break;
				}
			}
		}
	}
}