#include <a_samp>

#define WARNING_LIMIT 5
#define KICK_LIMIT 99

public OnFilterScriptInit()
{
	//Add any blacklists here!! add_source(name[], url[], weight)
    add_source("Lsrcr", "http://ls-rcr.com/api/api.php", 5);
    //add_source("SONA", "http://sona-gaming.com/rep/api.php", 5);//Currently inactive
	print("\n--------------------------------------");
	print(" SONA-Reputation example script by Johnson and Jeroen!");
	print("--------------------------------------\n");
	//lookup(ip[])
	return 1;
}

public OnFilterScriptExit()
{
	return 1;
}

public OnPlayerConnect(playerid)
{
    new rSTATUS = lookup(GetPlayerIp(playerid));
    if(rSTATUS >= WARNING_LIMIT)
	{
	    if(rSTATUS >= KICK_LIMIT)
	    {
	    }
	    else
	    {
	    }
	}
	else
	{
	}
	return 1;
}

public OnPlayerDisconnect(playerid, reason)
{
	return 1;
}

public OnPlayerText(playerid, text[])
{
	return 1;
}

public OnPlayerCommandText(playerid, cmdtext[])
{
	if (strcmp("/mycommand", cmdtext, true, 10) == 0)
	{
		// Do something here
		return 1;
	}
	return 0;
}

public OnRconCommand(cmd[])
{
	return 1;
}

public OnRconLoginAttempt(ip[], password[], success)
{
	return 1;
}

public OnPlayerClickPlayer(playerid, clickedplayerid, source)
{
	//Maybe add a rep lookup here?
	return 1;
}

stock SendToAdmins(COLOR,message[])
{
    new string[128];
    for(new i = 0; < MAX_PLAYERS; i++)
    if(IsPlayerAdmin(i))
    {
        SendClientMessage(i,COLOR,message);
    }
    return 0;
}
