# Wahana Mailer — User Guide

Everyday usage guide for `https://wahanatotalita.com/mailer/`. For installation, see
`DEPLOY.md` instead — this guide assumes the mailer is already deployed.

## First login

1. Go to `https://wahanatotalita.com/mailer/first-run.php` — this only works the very
   first time (before any admin account exists), then locks itself permanently.
2. Fill in your name, email, and a password (10+ characters). This creates your
   admin account and logs you in.
3. From then on, log in at `https://wahanatotalita.com/mailer/login.php`.
4. If you enter the wrong password 5 times in a row, the account locks for 15
   minutes as a security measure — just wait and try again.

## SMTP setup

1. Go to **Settings** in the top menu.
2. Fill in the SMTP block: host, port, encryption (SSL/TLS), username, password,
   from email, from name. These are pre-filled with sensible defaults for
   `info@wahanatotalita.com` — you mainly need to enter the mailbox password.
3. Click **Save Settings**.
4. Scroll to **Test SMTP connectivity**, enter your own email, and click
   **Send Test**. If it fails, the error message tells you what's wrong (usually a
   wrong password or port/encryption mismatch) — fix and retry before moving on.

## Import contacts

1. Go to **Contacts → Import CSV**.
2. Your CSV needs a header row with an `email` column (required). `name`, `company`,
   and `tags` columns are optional and can be in any order.
3. Upload the file. You'll see a summary: how many were imported/updated and how many
   rows were skipped (invalid or missing email).
4. Importing an email that already exists **updates** that contact instead of
   creating a duplicate — safe to re-import the same list after edits.
5. **Before importing a large new list, back up what you have**: go to
   **Contacts**, click **Export Contacts (CSV)**, and save the downloaded file
   somewhere safe.

## Create a campaign

1. Go to **Campaigns → New Campaign** (or **Templates** to browse designs first).
2. Pick a template: Corporate (formal announcements), Minimal (short personal notes),
   or Newsletter (multi-section updates).
3. Fill in the campaign name (internal only, not seen by recipients), subject, and
   the template's fields (headline/body, message, or section text depending on the
   template).
4. Set the **daily sending rules**: how many emails per day, and the start/end time
   window. Defaults come from Settings but can be changed per campaign.
5. Click **Save Draft**. You can come back and keep editing it until you queue it.

## Send a test email

While editing a draft campaign, scroll to **Send a test email**, enter your own
address, and click **Send Test**. This sends the real, fully rendered email exactly
as recipients will see it — always do this before queuing a real send. You can also
click **Preview** to open the rendered HTML in a new tab without sending anything.

## Start sending

1. On the same draft campaign page, scroll to **Ready to send** and click
   **Queue to Send**. Confirm the prompt.
2. This queues every currently **active** contact and cannot be undone — the
   campaign moves out of "draft" and can no longer be edited.
3. Sending itself happens automatically in the background (via the server's cron
   job) according to the daily limit and time window you set — you don't need to
   keep anything open or do anything further.

## Monitor progress

1. Go to **Campaigns** to see every campaign's status (draft / queued / sending /
   paused / sent) and a quick sent/total count.
2. Click **View** on any campaign to open its detail page: a progress bar, exact
   counts (sent / failed / pending), and a full send log per recipient with
   timestamps and error messages for anything that failed.
3. You can **Pause** an in-progress campaign at any time (cron will skip it) and
   **Resume** it later — it continues exactly where it left off.
4. The **Dashboard** shows a quick "Cron last ran" indicator — if this hasn't
   updated in a while (more than ~10 minutes), the scheduled sending job may have
   stopped running and is worth checking in hPanel.

## Add a new template

No code changes needed:
1. Create a new folder under `mailer/templates/`, e.g. `templates/holiday/`.
2. Add `template.html` (the email itself) and `config.json` (its editable fields) —
   copy an existing template folder as a starting point.
3. Optionally add `style.css` (browser-preview convenience only) and a
   `preview.png`/`.webp`/`.jpg` thumbnail.
4. Each existing template folder's `PROMPT.txt` contains the full design spec — hand
   that file to an AI along with "build a new template following this spec" to
   generate one that fits automatically.
5. Upload the new folder — it appears immediately in **Templates** and the campaign
   template picker, with no further setup.
