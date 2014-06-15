LampKontroll v0.2, Copyright 2014, Emil Lind <emil@sys.nu> 

About:
    LampKontroll is a small touchdevice-skinned webapp that spawns the 
    commandline utility of the Telldus-stick, which is a usb device to
    interface with remotecontrolled outlets using RF signals.

    - Emil Lind - http://www.emillind.se
    - Telldus stick - http://www.telldus.se

License:

    This file is part of LampKontroll v0.2

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

Requirements:

 * Webserver with PHP (I use apache with php5)

 * Configured telldus stick tdtool utility (search index.php for path)
   - Telldus stick - http://www.telldus.se

Installation notes:

 * Set up the webserver with php capabilities and serve this folder containing index.php and directories below

 * Make sure that your sudo is configure correctly, if you need to use tdtool as root.
   /etc/sudoers has the following lines (using visudo)
   www-data	ALL=NOPASSWD: /usr/bin/tdtool *


The code is pretty self explanitory and easy to tweak and update. 
If you do some cool updates, please send me a copy to <emil@sys.nu>. =)

Thank you Christopher Plieger, for making iWebkit 
which essentially brings all the looks and touchy knobs to LampKontroll.
Find out more about iWebkit and more at http://snippetspace.com/

