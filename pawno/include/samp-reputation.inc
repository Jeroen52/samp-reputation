#if defined _samp_reputation_included
	#endinput
#endif	
#define _samp_reputation_included

#include <a_HTTP>

#define REPUTATION_MAX_SOURCES 			10
#define REPUTATION_NAME_MAX_LENGTH 		32
#define REPUTATION_URL_MAX_LENGTH 		256

#define REPUTATION_SAFE				1
#define REPUTATION_THREAT_MINOR		2
#define REPUTATION_THREAT_MAJOR		3

#define reputation::%1(%2) reputation_%1(%2)

enum REPUTATION_SOURCES_DATA
{
	reputation_name[REPUTATION_NAME_MAX_LENGTH],
	reputation_url[REPUTATION_URL_MAX_LENGTH],
	reputation_weight
}

new 
	reputation_sources[REPUTATION_MAX_SOURCES][REPUTATION_SOURCES_DATA],
	reputation_source_count = 0;
	
forward reputation::check_source(index, response_code, data[]);

// -------------------------------------------------------------------------- //

stock reputation::add_source(name[REPUTATION_NAME_MAX_LENGTH], url[REPUTATION_URL_MAX_LENGTH], weight = 2)
{
	if(reputation_source_count == REPUTATION_MAX_SOURCES)
		return printf("SA-MP Reputation: Maximum source count reached, please increase REPUTATION_MAX_SOURCES.\n%s is not used.", url);
		
	printf("SA-MP Reputation: Attempting to add source '%s'...", name);
	
	format(reputation_sources[reputation_source_count][reputation_name], REPUTATION_URL_MAX_LENGTH, "%s", name);	
	format(reputation_sources[reputation_source_count][reputation_url], REPUTATION_URL_MAX_LENGTH, "%s", url);
	reputation_sources[reputation_source_count][reputation_weight] = weight;
	
	new query[REPUTATION_URL_MAX_LENGTH + 20];
	format(query, sizeof(query), "%s?lookup", url);
	HTTP(reputation_source_count, HTTP_GET, query, "", "reputation_check_source");
	return 1;
}

public reputation::check_source(index, response_code, data[])
{
	if(response_code == 200)
	{
		// Server responded
		printf("SA-MP Reputatation: Source '%s' was successfully added.", reputation_sources[index][reputation_name]);
		reputation_source_count++;
	}
	else
	{
		printf("SA-MP Reputation: Source %s did not respond and therefore has been disabled.", reputation_sources[index][reputation_name]);
		
		format(reputation_sources[reputation_source_count][reputation_name], REPUTATION_URL_MAX_LENGTH, "");	
		format(reputation_sources[reputation_source_count][reputation_url], REPUTATION_URL_MAX_LENGTH, "");
		reputation_sources[reputation_source_count][reputation_weight] = 0;
	}
}