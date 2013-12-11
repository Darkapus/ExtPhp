<?php
namespace Base\Model\Component\Core;

/**
 * on se sert de la class Config pour générer le json de configuration des elements extjs
 * @author bbaschet
 * 
 */
class Config
{
	/**
	 * ajoute un attribut à la configuration. Attention le parametre $o est subtile, 
	 * il permet de définir si on doit traiter ou non la chaine comme une string
	 * une chaine traitée comme une string sera alors entourée par des quotes
	 * cela peut être une source de bugs multiples. 
	 * @param string $k
	 * @param string $v
	 * @param boolean $o
	 */
	function addAttribute($k, $v, $o=false)
	{
		if($o || is_object($v)) $this->$k = $v;
		else $this->$k = "'$v'";
		
		return $this;
	}
	/**
	 * modifie un attribut à la configuration. Attention le parametre $o est subtile,
	 * il permet de définir si on doit traiter ou non la chaine comme une string
	 * une chaine traitée comme une string sera alors entourée par des quotes
	 * cela peut être une source de bugs multiples.
	 * @param string $k
	 * @param string $v
	 * @param boolean $o
	 */
	function setAttribute($k, $v, $o=false)
	{
		if($o || is_object($v)) $this->$k = $v;
		else $this->$k = "'$v'";
		
		return $this;
	}
	/**
	 * construit tout le json necessaire pour le parametrage extjs
	 * on ne passe pas par un json encode et c'est normale. 
	 * json encode ne prend pas en considération les objets invoqué, 
	 * on peut retrouver des objets javascript en string avec json encode
	 * @param string $key
	 * @return string
	 */
	function getJson($key=null)
	{
		$json = '';
		if(!is_null($key)) $json .= $key.': ';
		$json .= '{'.RC;
		foreach($this as $k=>$v)
		{
			if(is_object($v) && method_exists($v, 'getJson'))
			{
				$json .= $v->getJson($k).','.RC;
			}
			elseif(is_array($v))
			{
				$json .= $k.': ['.RC;
				foreach($v as $val)
				{
					if(is_object($val))
					{
						$json .= $val->getJson().','.RC;
					}
					else $json .= $val.','.RC;
				}
				$json .= '],'.RC;
			}
			else 
			{
				$json .= $k.':'.$v.','.RC;
			}
		}
		$json .= '}'.RC;
		return $json;//json_encode($this);
	}
}