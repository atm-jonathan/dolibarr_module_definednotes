<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file    class/actions_definednotes.class.php
 * \ingroup definednotes
 * \brief   This file is an example hook overload class file
 *          Put some comments here
 */

/**
 * Class ActionsDefinedNotes
 */
class ActionsDefinedNotes
{
	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * @var array Errors
	 */
	public $errors = array();

	/**
	 * Constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Overloading the doActions function : replacing the parent's function with the one below
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	
	function editDictionaryFieldlist($parameters, &$object, &$action, $hookmanager) {
		
		global $conf;
		
	//	if(empty($conf->global->FCKEDITOR_ENABLE_SOCIETE)) return 0;
		
		echo '<td><input class="flat quatrevingtpercent" value="'.htmlentities($object->label).'" name="label" type="text"></td>';
		
		dol_include_once('/core/class/doleditor.class.php');
		$doleditor = new DolEditor('content',$object->content); 
		echo '<td>'.$doleditor->Create(1).'</td>';
		
		return 1;
		
	}
	
	function formobjectoptions($parameters, &$object, &$action, $hookmanager)
	{
		//var_dump($parameters,$object);
		
		if($action == 'create' && in_array('globalcard',explode(':',$parameters['context']))) {
		
			global $langs;
			
			$langs->load('definednotes@definednotes');
			
			$array=Array(1=>'test');
			$form=new Form($this->db);
			
			echo '<tr><td>';
				echo $langs->trans('PredefinedNotePublic');
			echo '</td>';
				
				echo $form->selectarray('predefined_note_public', $array,0,1);
			
			echo '</tr>';

			echo '<tr><td>';
			echo $langs->trans('PredefinedNotePrivate');
			echo '</td>';
				echo $form->selectarray('predefined_note_private', $array,0,1);
			
			
			echo '</tr>';
			
		}
		
	}
}