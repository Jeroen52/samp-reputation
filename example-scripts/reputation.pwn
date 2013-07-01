#include <a_samp>
#include <samp-reputation>

#define WARNING_LIMIT 5
#define KICK_LIMIT 99

public OnFilterScriptInit()
{
	print("\n--------------------------------------");
	print(" SA-MP Reputation example script by Johnson and Jeroen!");
	print("--------------------------------------\n");
	
	// Add any blacklists here
	// reputation::add_source(name[], url[], weight)
	// URLs should be without the protocol (http://)
	
    reputation::add_source("Ls-rcr", "ls-rcr.com/api/samp-reputation/", 5);
	reputation::add_source("Sona", "sona-gaming.com/api/samp-reputation/", 5);
	return 1;
}

public OnFilterScriptExit()
{
	return 1;
}

public OnPlayerConnect(playerid)
{
    /*new rSTATUS = lookup(GetPlayerIp(playerid));
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
	}*/
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
