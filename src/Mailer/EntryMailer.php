<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;

class EntryMailer extends Mailer
{
	public function newEntryToOrganiser($entry)
	{
		$this->to($user->email)
			->subject(sprintf('Welcome %s', $user->name))
			->template('welcome_mail') // By default template with same name as method name is used.
		->layout('custom');
	}
	public function newEntryToPunter($entry)
	{
		$punter = TableRegistry::get('Users')->find()->where(['id'=>$entry->user_id])->first();
		$competition = TableRegistry::get('Competitions')->find()->where(['id'=>$entry->competition_id])->first();

		$this
			->to($punter->email)
			->template('to_punter_new_entry')
			->layout('puntoon')
			->message("hello mummy")
			->subject(sprintf('New Punt: %s in %s', $entry->name, $competition->name))
			->set($entry);
// 			->set(['firstname' => $punter->firstname]);
	}
}
