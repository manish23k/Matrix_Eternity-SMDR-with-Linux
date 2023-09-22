#!/usr/bin/perl
use DBI;
use DBD::mysql;
use strict;
use IO::Socket;
use POSIX;
use warnings; 
#initialize host and port
#my $host = shift || $ARGV[0];
#my $port = shift || $ARGV[1];
#Configure local Computer IP address as $host and local TCP port as $port. Configure same port @Eternity/NAVAN for Online SMDR outgoing, incoming & internal calls
my $host = "192.168.0.201";
my $port = 5555;
my $proto = getprotobyname('tcp');
my $iaddr = inet_aton($host);
my $paddr = sockaddr_in($port, $iaddr);

for(;;){
my ($sock,$client_socket);
$sock = new IO::Socket::INET(LocalHost => $host, LocalPort => $port, Proto => "tcp",Listen => 5,Reuse => 1)
or die "Cannot connect to PBX at address: $host port: $port: $!";
$client_socket = $sock->accept();
#my $data = <$client_socket>;
while (<$client_socket>) {
s/^\0+//; # Remove leading null characters
print $_;
chomp ($_);
my $calltype = substr($_, 69,2);
my $calltype2 = substr($_, 77,2);
$calltype =~ s/^\s+//;
$calltype2 =~ s/^\s+//;
#print $calltype;
chomp ($calltype);
#print $calltype2;
chomp ($calltype2);
#$_ =~ s/^[^ ]+//;
if ($calltype =~/T|N|U|D|I/ and $_ =~/V/) {
#&TXTout;
&DBvoipic; #send data to the database subroutine
}
elsif ($calltype =~/T|N|U|D|I/) {
#&TXTout;
&DBconnectic; #send data to the database subroutine
}
elsif ($calltype2 =~/TI|I|R|C|D/ and $_ =~/V/) {
#&TXTout;
&DBvoipog; #send data to the database subroutine
}
elsif ($calltype2 =~/TI|I|R|C|D/) {
#&TXTout;
&DBconnectog; #send data to the database subroutine
}
elsif ($_ =~/IN/) {
#&TXTout;
&DBinternal; #send data to the database subroutine
}
} #Close While loop

sub DBinternal {
#MySQL Connection parameters
my $dbuser = "cron";
my $dbpassword = "1234";
my $dbhost = "localhost";
my $database = "voicecatch";
my ($line, $mon, $day, $stime, $sec, $caller, $called, $tester);

			$mon = substr ($_, 43,2);
			$day = substr ($_, 40,2);
			$stime = substr($_, 52,8);
			$sec = substr($_, 62,5);
			$sec =~ s/^\s+//;
			$caller = substr($_, 11,5);
			$called = substr($_, 28,5);
			$tester = strftime( "%Y",localtime(time));

#Establish the connection which returns a DB handle
my $dbh = DBI->connect("DBI:mysql:database=$database:host=$dbhost",$dbuser,$dbpassword) or die $DBI::errstr;
#Prepare the SQL statement
my $sth = $dbh->prepare("INSERT INTO internal VALUE(?,?,?,?,?,?,?,?)") or die $DBI::errstr;
#Send the statement to the server
#my $sth = $dbh->prepare( "SELECT * FROM import");

#execute the query
#$sth->execute( );
#Retrieve the results of a row of data and print
#print "\tQuery results:\n================================================\n";
$sth->execute($mon,$day,$stime,$sec,$caller,$called,$tester,'');
#Close the database connection
$dbh->disconnect or die $DBI::errstr;
#$connection == disconnect or die $DBI::errstr;
} #Close DBconnect subroutine


sub DBconnectic {
# MySQL Connection parameters
my $dbuser = "cron";
my $dbpassword = "1234";
my $dbhost = "localhost";
my $database = "voicecatch";
my ($line, $mon, $day, $stime, $pm, $hrs, $mins, $sec, $callp, $leaddigit, $callno, $calltype, $callp2, $transf, $sysid, $tester);

			$mon = substr ($_, 39,2);
			$day = substr ($_, 36,2);
			$stime = substr($_, 47,8);
			$pm = substr($_, 11,1);
			$hrs = substr($_, 47,2);
			$mins = substr($_, 50,2);
			$sec = substr($_, 64,5);
			$sec =~ s/^\s+//;
			$callp = substr($_, 6,16);
			$leaddigit = substr($_, 6,1);
			$callno = substr($_, 23,4);
			$calltype = substr($_, 69,2);
			$calltype =~ s/^\s+//;
			$callp2 = substr($_, 31,4);
			$callp2 =~ s/^\s+//;
			$transf = substr($_, 4,1);
			$sysid = substr($_, 4,1);
			$tester = strftime( "%Y",localtime(time));

# Establish the connection which returns a DB handle
my $dbh = DBI->connect("DBI:mysql:database=$database:host=$dbhost",$dbuser,$dbpassword) or die $DBI::errstr;
# Prepare the SQL statement
my $sth = $dbh->prepare("INSERT INTO incall VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die $DBI::errstr;
# Send the statement to the server
#my $sth = $dbh->prepare( "SELECT * FROM import");

#execute the query
#$sth->execute( );
## Retrieve the results of a row of data and print
#print "\tQuery results:\n================================================\n";
$sth->execute($mon,$day,$stime,'','','',$sec,$callp,'',$callno,$calltype,$callp2,'','',$tester,'');
# Close the database connection
$dbh->disconnect or die $DBI::errstr;
#$connection == disconnect or die $DBI::errstr;
} #Close DBconnect subroutine

sub DBconnectog {
# MySQL Connection parameters
my $dbuser = "cron";
my $dbpassword = "1234";
my $dbhost = "localhost";
my $database = "voicecatch";
my ($line, $mon, $day, $stime, $pm, $hrs, $mins, $sec, $callp, $leaddigit, $callno, $calltype, $callp2, $acccode, $cost, $tester);

			$mon = substr ($_, 43,2);
			$day = substr ($_, 40,2);
			$stime = substr($_, 49,8);
			$pm = substr($_, 11,1);
			$hrs = substr($_, 47,2);
			$mins = substr($_, 50,2);
			$sec = substr($_, 58,5);
			$sec =~ s/^\s+//;
			$callp = substr($_, 16,4);
			$leaddigit = substr($_, 6,1);
			$callno = substr($_, 21,16);
			$calltype = substr($_, 77,2);
			$calltype =~ s/^\s+//;
			$callp2 = substr($_, 7,4);
			$callp2 =~ s/^\s+//;
			$acccode = substr($_, 12,3);
			$cost = substr($_, 71,5);
			$cost =~ s/^\s+//;
			$tester = strftime( "%Y",localtime(time));

# Establish the connection which returns a DB handle
my $dbh = DBI->connect("DBI:mysql:database=$database:host=$dbhost",$dbuser,$dbpassword) or die $DBI::errstr;
# Prepare the SQL statement
my $sth = $dbh->prepare("INSERT INTO import VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die $DBI::errstr;
# Send the statement to the server
#my $sth = $dbh->prepare( "SELECT * FROM import");

#execute the query
#$sth->execute( );
## Retrieve the results of a row of data and print
#print "\tQuery results:\n================================================\n";
$sth->execute($mon,$day,$stime,'','','',$sec,$callp,'',$callno,$calltype,$callp2,$acccode,$cost,$tester,'');
# Close the database connection
$dbh->disconnect or die $DBI::errstr;
#$connection == disconnect or die $DBI::errstr;
} #Close DBconnect subroutine

sub DBvoipic {
# MySQL Connection parameters
my $dbuser = "cron";
my $dbpassword = "1234";
my $dbhost = "localhost";
my $database = "voicecatch";
my ($line, $mon, $day, $stime, $pm, $hrs, $mins, $sec, $callp, $leaddigit, $callno, $calltype, $callp2, $transf, $sysid, $tester);

			$mon = substr ($_, 39,2);
			$day = substr ($_, 36,2);
			$stime = substr($_, 47,8);
			$pm = substr($_, 11,1);
			$hrs = substr($_, 47,2);
			$mins = substr($_, 50,2);
			$sec = substr($_, 64,5);
			$sec =~ s/^\s+//;
			$callp = substr($_, 6,16);
			$leaddigit = substr($_, 6,1);
			$callno = substr($_, 23,4);
			$calltype = substr($_, 69,2);
			$calltype =~ s/^\s+//;
			$callp2 = substr($_, 31,4);
			$callp2 =~ s/^\s+//;
			$transf = substr($_, 4,1);
			$sysid = substr($_, 4,1);
			$tester = strftime( "%Y",localtime(time));

# Establish the connection which returns a DB handle
my $dbh = DBI->connect("DBI:mysql:database=$database:host=$dbhost",$dbuser,$dbpassword) or die $DBI::errstr;
# Prepare the SQL statement
my $sth = $dbh->prepare("INSERT INTO invoip VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die $DBI::errstr;
# Send the statement to the server
#my $sth = $dbh->prepare( "SELECT * FROM import");

#execute the query
#$sth->execute( );
## Retrieve the results of a row of data and print
#print "\tQuery results:\n================================================\n";
$sth->execute($mon,$day,$stime,'','','',$sec,$callp,'',$callno,$calltype,$callp2,'','',$tester,'');
# Close the database connection
$dbh->disconnect or die $DBI::errstr;
#$connection == disconnect or die $DBI::errstr;
} #Close DBconnect subroutine

sub DBvoipog {
# MySQL Connection parameters
my $dbuser = "cron";
my $dbpassword = "1234";
my $dbhost = "localhost";
my $database = "voicecatch";
my ($line, $mon, $day, $stime, $pm, $hrs, $mins, $sec, $callp, $leaddigit, $callno, $calltype, $callp2, $acccode, $cost, $tester);

			$mon = substr ($_, 43,2);
			$day = substr ($_, 40,2);
			$stime = substr($_, 49,8);
			$pm = substr($_, 11,1);
			$hrs = substr($_, 47,2);
			$mins = substr($_, 50,2);
			$sec = substr($_, 58,5);
			$sec =~ s/^\s+//;
			$callp = substr($_, 16,4);
			$leaddigit = substr($_, 6,1);
			$callno = substr($_, 21,16);
			$calltype = substr($_, 77,2);
			$calltype =~ s/^\s+//;
			$callp2 = substr($_, 7,4);
			$callp2 =~ s/^\s+//;
			$acccode = substr($_, 12,3);
			$cost = substr($_, 71,5);
			$cost =~ s/^\s+//;
			$tester = strftime( "%Y",localtime(time));

# Establish the connection which returns a DB handle
my $dbh = DBI->connect("DBI:mysql:database=$database:host=$dbhost",$dbuser,$dbpassword) or die $DBI::errstr;
# Prepare the SQL statement
my $sth = $dbh->prepare("INSERT INTO ogvoip VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)") or die $DBI::errstr;
# Send the statement to the server
#my $sth = $dbh->prepare( "SELECT * FROM import");

#execute the query
#$sth->execute( );
## Retrieve the results of a row of data and print
#print "\tQuery results:\n================================================\n";
$sth->execute($mon,$day,$stime,'','','',$sec,$callp,'',$callno,$calltype,$callp2,$acccode,$cost,$tester,'');
# Close the database connection
$dbh->disconnect or die $DBI::errstr;
#$connection == disconnect or die $DBI::errstr;
} #Close DBconnect subroutine

#close the socket
close $client_socket or die "close: $!";
print "socket closed";
print "<br />";
#close the socket
close $client_socket or die "close: $!";
print "socket closed";
print "<br />";
}
